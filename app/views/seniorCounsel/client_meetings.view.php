<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Meeting Requests</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/meetings.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    .status-select {
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    /* Search and sort controls */
    .controls-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px;
        flex-wrap: wrap;
    }

    .search-container {
        display: flex;
        align-items: center;
        background: white;
        border-radius: 4px;
        padding: 5px 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    .search-container input {
        border: none;
        outline: none;
        padding: 8px;
        width: 100%;
        font-size: 14px;
    }

    .search-container i {
        color: #777;
        margin-right: 5px;
    }

    .sort-container {
        display: flex;
        align-items: center;
    }

    .sort-container select {
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ddd;
        background-color: white;
        margin-left: 10px;
        cursor: pointer;
    }

    .sort-label {
        font-weight: bold;
        color: #1d1b31;
    }

    /* No results message */
    .no-results {
        text-align: center;
        padding: 20px;
        color: #777;
        font-style: italic;
    }
</style>


<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <div class="message-container">

        <?php include('component/sidebar.view.php'); ?>


        <section class="home-section">
            <div class="meeting-section">
                <h1>Client Meeting Requests</h1>
            </div>
            <div class="meeting-paragraph">
                <p>Here you can view the client meeting requests and their status. Select buttons to filter the details </p>
            </div>

            <!-- Search and Sort Controls -->
            <div class="controls-container">
                <div class="search-container">
                    <i class='bx bx-search'></i>
                    <input type="text" id="searchInput" placeholder="Search by client name, purpose...">
                </div>

                <div class="sort-container">
                    <span class="sort-label">Sort by:</span>
                    <select id="sortSelect">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="name">Client Name</option>
                        <option value="date">Meeting Date</option>
                    </select>
                </div>
            </div>

            <div class="filter-buttons">
                <button class="filter-btn all active" data-status="all">All</button>
                <button class="filter-btn pending" data-status="Pending">Pending</button>
                <button class="filter-btn accepted" data-status="Accepted">Accepted</button>
                <button class="filter-btn rejected" data-status="Rejected">Rejected</button>
            </div>


            <div class="content">
                <table>
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Date Created</th>
                            <th>Requested Date</th>
                            <th>Meeting Purpose</th>
                            <th>Comments</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="meetingsTableBody">
                        <?php if (!empty($meetingDetails)): ?>
                            <?php foreach ($meetingDetails as $meeting): ?>
                                <tr data-created="<?= strtotime($meeting->created_at) ?>"
                                    data-name="<?= strtolower($meeting->first_name . ' ' . $meeting->last_name) ?>"
                                    data-date="<?= strtotime($meeting->meeting_date) ?>"
                                    data-status="<?= $meeting->meeting_status ?>">
                                    <td><?= $meeting->first_name . ' ' . $meeting->last_name ?></td>
                                    <td><?= date('Y.m.d', strtotime($meeting->created_at)) ?></td>
                                    <td><?= date('Y.m.d', strtotime($meeting->meeting_date)) ?></td>
                                    <td><?= $meeting->meeting_purpose ?></td>
                                    <td><?= $meeting->meeting_comments ?></td>
                                    <td><?= $meeting->phone ?></td>
                                    <td>
                                        <select class="status-select" data-meeting-id="<?= $meeting->id ?>" data-current="<?= $meeting->meeting_status ?>">
                                            <option value="Pending" <?= $meeting->meeting_status == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="Accepted" <?= $meeting->meeting_status == 'Accepted' ? 'selected' : '' ?>>Accepted</option>
                                            <option value="Rejected" <?= $meeting->meeting_status == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr id="noMeetingsRow">
                                <td colspan="7">No meetings found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- No results message (hidden by default) -->
                <div id="noResultsMessage" class="no-results" style="display: none;">
                    No meetings match your search criteria
                </div>
            </div>
        </section>
    </div>
</body>

</html>

<script>
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            const meetingId = this.dataset.meetingId;
            const newStatus = this.value;

            fetch(`<?= ROOT ?>/MeetingsLawyer/updateMeetingStatus`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        meeting_id: meetingId,
                        meeting_status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.className = 'status-select ' + newStatus.toLowerCase();
                        this.setAttribute('data-current', newStatus);

                        // Update the row's data-status attribute for filtering
                        this.closest('tr').setAttribute('data-status', newStatus);

                        // Re-apply current filter
                        const activeFilter = document.querySelector('.filter-btn.active');
                        if (activeFilter) {
                            filterByStatus(activeFilter.dataset.status);
                        }
                    }
                });
        });
    });

    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            const status = this.dataset.status;
            filterByStatus(status);
        });
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function() {
        applyFiltersAndSort();
    });

    // Sort functionality
    const sortSelect = document.getElementById('sortSelect');
    sortSelect.addEventListener('change', function() {
        applyFiltersAndSort();
    });

    // Function to filter by status
    function filterByStatus(status) {
        // Store the current status filter
        window.currentStatusFilter = status;
        applyFiltersAndSort();
    }

    // Function to apply all filters and sorting
    function applyFiltersAndSort() {
        const searchTerm = searchInput.value.toLowerCase();
        const sortOption = sortSelect.value;
        const statusFilter = window.currentStatusFilter || 'all';

        const rows = Array.from(document.querySelectorAll('#meetingsTableBody tr:not(#noMeetingsRow)'));
        let visibleCount = 0;

        // First, sort the rows
        rows.sort((a, b) => {
            switch (sortOption) {
                case 'newest':
                    return parseInt(b.dataset.created) - parseInt(a.dataset.created);
                case 'oldest':
                    return parseInt(a.dataset.created) - parseInt(b.dataset.created);
                case 'name':
                    return a.dataset.name.localeCompare(b.dataset.name);
                case 'date':
                    return parseInt(a.dataset.date) - parseInt(b.dataset.date);
                default:
                    return 0;
            }
        });

        // Then filter and reorder
        rows.forEach(row => {
            // Get all text content from the row for searching
            const rowText = row.textContent.toLowerCase();
            const rowStatus = row.dataset.status;

            // Check if row matches both search and status filters
            const matchesSearch = searchTerm === '' || rowText.includes(searchTerm);
            const matchesStatus = statusFilter === 'all' || rowStatus === statusFilter;

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Reorder the table
        const tbody = document.getElementById('meetingsTableBody');
        rows.forEach(row => tbody.appendChild(row));

        // Show/hide no results message
        const noResultsMessage = document.getElementById('noResultsMessage');
        if (visibleCount === 0 && rows.length > 0) {
            noResultsMessage.style.display = 'block';
        } else {
            noResultsMessage.style.display = 'none';
        }
    }

    // Initialize with default sort (newest first)
    document.addEventListener('DOMContentLoaded', function() {
        applyFiltersAndSort();
    });
</script>