<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cases List</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/case.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Status badge styles */
        .status-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 0.9em;
            font-weight: bold;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-ongoing {
            background-color: rgba(59, 209, 124, 0.55);
            color: white;
        }

        .status-closed {
            background-color: rgba(254, 94, 94, 0.81);
            color: white;

        }

        /* Status dropdown styles */
        .status-container {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            gap: 8px;
        }

        .status-select {
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
            color: #1d1b31;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-grow: 1;
        }

        .status-select:hover,
        .status-select:focus {
            border-color: #fa9800;
            outline: none;
        }

        .update-status-btn {
            background-color: #93a8e3;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 0.9em;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .update-status-btn:hover {
            background-color: rgb(143, 173, 255);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        /* Option styles for dropdown */
        .status-select option {
            padding: 8px;
            font-weight: 500;
        }

        /* Case card hover effect */
        .case-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .case-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Tab styles */
        .cases-tabs {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            border-bottom: 2px solid #eee;
        }

        .tab-button {
            padding: 10px 20px;
            margin: 0 10px;
            background: none;
            border: none;
            font-size: 16px;
            font-weight: 600;
            color: #777;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }

        .tab-button:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #fa9800;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .tab-button.active {
            color: #1d1b31;
        }

        .tab-button.active:after {
            transform: scaleX(1);
        }

        .tab-button:hover {
            color: #1d1b31;
        }

        .cases-section {
            display: none;
        }

        .cases-section.active {
            display: block;
        }

        .section-title {
            margin: 20px 0;
            font-size: 1.2em;
            color: #1d1b31;
            font-weight: 600;
            text-align: center;
        }

        .no-cases-message {
            text-align: center;
            padding: 20px;
            color: #777;
            font-style: italic;
        }
    </style>
</head>


<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    <div class="home-section">
        <div class="allcases-section">
            <h1>List of All Cases</h1>
        </div>
        <div class="paragraph-all-cases">
            Click here to add a
            <span style="color: #fa9800; font-weight: bold;">new case</span> or to view details in
            <span style="color: #fa9800; font-weight: bold;">tabular view</span>.
        </div>

        <div class="button">
            <a href="<?= ROOT ?>/cases">
                <button class="add">Add New Case</button>
            </a>
            <a href="<?= ROOT ?>/cases/extendRetrieveAllCases">
                <button class="add">Tabular View</button>
            </a>
        </div>

        <div class="search-container">
            <form id="search-form" class="search-form">
                <div class="search-input-group">
                    <input type="text" id="search-query" placeholder="Search cases " class="search-input">
                    <select id="search-field" class="search-select">
                        <option value="all">All Fields</option>
                        <option value="case_number">Case Number</option>
                        <option value="client_name">Client Name</option>
                        <option value="court">Court</option>
                        <option value="notes">Notes</option>
                    </select>
                    <button type="submit" class="search-button">
                        <i class="bx bx-search"></i> Search
                    </button>
                </div>
            </form>
            <div id="search-results-count" class="search-results-count"></div>
        </div>

        <!-- Sort Functionality -->
        <div class="sort-container">
            <label for="sort-select">Sort by:</label>
            <select id="sort-select" class="sort-select">
                <option value="default">Default</option>
                <option value="client_asc">Client Name (A-Z)</option>
                <option value="client_desc">Client Name (Z-A)</option>
                <option value="case_asc">Case Number (A-Z)</option>
                <option value="case_desc">Case Number (Z-A)</option>
                <option value="court_asc">Court Name (A-Z)</option>
                <option value="court_desc">Court Name (Z-A)</option>
                <option value="date_asc">Date (Oldest First)</option>
                <option value="date_desc">Date (Newest First)</option>
            </select>
        </div>



        <!-- Case Status Tabs -->
        <div class="cases-tabs">
            <button class="tab-button active" data-tab="all-cases">All Cases</button>
            <button class="tab-button" data-tab="ongoing-cases">Ongoing Cases</button>
            <button class="tab-button" data-tab="closed-cases">Closed Cases</button>
        </div>

        <!-- All Cases Section -->
        <div class="cases-section active" id="all-cases">
            <div class="cases-container">
                <?php if (!empty($cases)) : ?>
                    <?php foreach ($cases as $case) : ?>
                        <div class="case-card" data-id="<?= $case->id ?>" data-date="<?= $case->created_at ?? date('Y-m-d') ?>">
                            <h3>Case Number: <?= htmlspecialchars($case->case_number) ?></h3>
                            <p><strong>Client Name:</strong> <?= htmlspecialchars($case->client_name) ?></p>
                            <p><strong>Court:</strong> <?= htmlspecialchars($case->court) ?></p>

                            <!-- Case Status Badge -->
                            <div class="status-badge status-<?= $case->case_status ?? 'ongoing' ?>">
                                Status: <?= ucfirst(htmlspecialchars($case->case_status ?? 'ongoing')) ?>
                            </div>

                            <!-- Status Update Form -->
                            <div class="status-container">
                                <select class="status-select" id="status-<?= $case->id ?>">
                                    <option value="ongoing" <?= ($case->case_status == 'ongoing' || empty($case->case_status)) ? 'selected' : '' ?>>Ongoing</option>
                                    <option value="closed" <?= ($case->case_status == 'closed') ? 'selected' : '' ?>>Closed</option>
                                </select>
                                <button class="update-status-btn" onclick="updateCaseStatus(<?= $case->id ?>)">Update Status</button>
                            </div>

                            <p><strong>Notes:</strong> <?= htmlspecialchars($case->notes) ?></p>

                            <div class="button">
                                <a href="<?= ROOT ?>/cases/retrieveCase/<?= $case->id; ?>">
                                    <button class="more">Open Case</button>
                                </a>

                                <a href="<?= ROOT ?>/cases/editCase/<?= $case->id; ?>">
                                    <button class="edit">
                                        <i class="bx bx-edit"></i> <!-- Boxicon for Edit -->
                                    </button>
                                </a>

                                <a href="javascript:void(0);" onclick="confirmDelete(<?= $case->id; ?>)">
                                    <button class="delete">
                                        <i class="bx bx-trash"></i> <!-- Boxicon for Delete -->
                                    </button>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="no-cases-message">No cases found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Ongoing Cases Section -->
        <div class="cases-section" id="ongoing-cases">
            <div class="cases-container">
                <?php
                $ongoingCases = array_filter($cases ?? [], function ($case) {
                    return $case->case_status == 'ongoing' || empty($case->case_status);
                });

                if (!empty($ongoingCases)) :
                ?>
                    <?php foreach ($ongoingCases as $case) : ?>
                        <!-- Inside each case card in all three sections (all, ongoing, closed) -->
                        <div class="case-card" data-id="<?= $case->id ?>" data-date="<?= $case->created_at ?? date('Y-m-d') ?>">
                            <h3 title="<?= htmlspecialchars($case->case_number) ?>">Case Number: <?= htmlspecialchars($case->case_number) ?></h3>
                            <p><strong>Client Name:</strong> <?= htmlspecialchars($case->client_name) ?></p>
                            <p><strong>Court:</strong> <?= htmlspecialchars($case->court) ?></p>

                            <!-- Case Status Badge -->
                            <div class="status-badge status-<?= $case->case_status ?? 'ongoing' ?>">
                                Status: <?= ucfirst(htmlspecialchars($case->case_status ?? 'ongoing')) ?>
                            </div>

                            <!-- Status Update Form -->
                            <div class="status-container">
                                <select class="status-select" id="status-<?= $case->id ?>">
                                    <option value="ongoing" <?= ($case->case_status == 'ongoing' || empty($case->case_status)) ? 'selected' : '' ?>>Ongoing</option>
                                    <option value="closed" <?= ($case->case_status == 'closed') ? 'selected' : '' ?>>Closed</option>
                                </select>
                                <button class="update-status-btn" onclick="updateCaseStatus(<?= $case->id ?>)">Update Status</button>
                            </div>

                            <div class="notes-container">
                                <p><strong>Notes:</strong> <?= htmlspecialchars($case->notes) ?></p>
                            </div>

                            <div class="button">
                                <a href="<?= ROOT ?>/cases/retrieveCase/<?= $case->id; ?>">
                                    <button class="more">Open Case</button>
                                </a>

                                <a href="<?= ROOT ?>/cases/editCase/<?= $case->id; ?>">
                                    <button class="edit">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                </a>

                                <a href="javascript:void(0);" onclick="confirmDelete(<?= $case->id; ?>)">
                                    <button class="delete">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </a>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="no-cases-message">No ongoing cases found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Closed Cases Section -->
        <div class="cases-section" id="closed-cases">
            <div class="cases-container">
                <?php
                $closedCases = array_filter($cases ?? [], function ($case) {
                    return $case->case_status == 'closed';
                });

                if (!empty($closedCases)) :
                ?>
                    <?php foreach ($closedCases as $case) : ?>
                        <div class="case-card" data-id="<?= $case->id ?>" data-date="<?= $case->created_at ?? date('Y-m-d') ?>">
                            <h3>Case Number: <?= htmlspecialchars($case->case_number) ?></h3>
                            <p><strong>Client Name:</strong> <?= htmlspecialchars($case->client_name) ?></p>
                            <p><strong>Court:</strong> <?= htmlspecialchars($case->court) ?></p>

                            <!-- Case Status Badge -->
                            <div class="status-badge status-closed">
                                Status: Closed
                            </div>

                            <!-- Status Update Form -->
                            <div class="status-container">
                                <select class="status-select" id="status-closed-<?= $case->id ?>">
                                    <option value="ongoing">Ongoing</option>
                                    <option value="closed" selected>Closed</option>
                                </select>
                                <button class="update-status-btn" onclick="updateCaseStatus(<?= $case->id ?>, 'closed')">Update Status</button>
                            </div>

                            <p><strong>Notes:</strong> <?= htmlspecialchars($case->notes) ?></p>

                            <div class="button">
                                <a href="<?= ROOT ?>/cases/retrieveCase/<?= $case->id; ?>">
                                    <button class="more">Open Case</button>
                                </a>

                                <a href="<?= ROOT ?>/cases/editCase/<?= $case->id; ?>">
                                    <button class="edit">
                                        <i class="bx bx-edit"></i> <!-- Boxicon for Edit -->
                                    </button>
                                </a>

                                <a href="javascript:void(0);" onclick="confirmDelete(<?= $case->id; ?>)">
                                    <button class="delete">
                                        <i class="bx bx-trash"></i> <!-- Boxicon for Delete -->
                                    </button>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="no-cases-message">No closed cases found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        // Tab switching functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const casesSections = document.querySelectorAll('.cases-section');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons and sections
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    casesSections.forEach(section => section.classList.remove('active'));

                    // Add active class to clicked button
                    this.classList.add('active');

                    // Show corresponding section
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });
        });

        function confirmDelete(caseId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this case? This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#93a8e3',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                background: '#fafafa',
                color: '#1d1b31',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the delete action
                    window.location.href = `<?= ROOT ?>/cases/deleteCase/${caseId}`;
                }
            });
        }

        function updateCaseStatus(caseId, tabPrefix = '') {
            const selectId = tabPrefix ? `status-${tabPrefix}-${caseId}` : `status-${caseId}`;
            const newStatus = document.getElementById(selectId).value;

            Swal.fire({
                title: 'Update Case Status',
                text: `Change status to ${newStatus.toUpperCase()}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#fa9800',
                cancelButtonColor: '#1d1b31',
                confirmButtonText: 'Yes, update it!',
                background: '#fafafa',
                color: '#1d1b31',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to update status
                    fetch(`<?= ROOT ?>/cases/updateStatus/${caseId}/${newStatus}`, {
                            method: 'POST',
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Case status updated successfully',
                                    icon: 'success',
                                    confirmButtonColor: '#fa9800',
                                    background: '#fafafa',
                                    color: '#1d1b31',
                                }).then(() => {
                                    // Reload the page to show updated status
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.message || 'Failed to update case status',
                                    icon: 'error',
                                    confirmButtonColor: '#fa9800',
                                    background: '#fafafa',
                                    color: '#1d1b31',
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong. Please try again.',
                                icon: 'error',
                                confirmButtonColor: '#fa9800',
                                background: '#fafafa',
                                color: '#1d1b31',
                            });
                        });
                }
            });
        }

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('search-form');
            const searchInput = document.getElementById('search-query');
            const searchField = document.getElementById('search-field');
            const resetButton = document.getElementById('reset-search');
            const allCaseCards = document.querySelectorAll('.case-card');

            // Store original case card HTML for reset
            const originalCards = {};
            allCaseCards.forEach(card => {
                const cardTitle = card.querySelector('h3')?.textContent || '';
                if (cardTitle) {
                    originalCards[cardTitle] = card.innerHTML;
                }
            });

            // Function to perform search
            function performSearch() {
                const query = searchInput.value.trim().toLowerCase();

                // If search is empty, reset the view
                if (query === '') {
                    resetSearch();
                    return;
                }

                const field = searchField.value;
                let resultsFound = 0;

                // Add search-active class to body
                document.body.classList.add('search-active');

                // Show all sections for searching
                document.querySelectorAll('.cases-section').forEach(section => {
                    section.classList.remove('active');
                });
                document.getElementById('all-cases').classList.add('active');

                // Update active tab
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('active');
                });
                document.querySelector('[data-tab="all-cases"]').classList.add('active');

                allCaseCards.forEach(card => {
                    let match = false;

                    // Reset card content to original
                    const cardTitle = card.querySelector('h3')?.textContent || '';
                    if (cardTitle && originalCards[cardTitle]) {
                        card.innerHTML = originalCards[cardTitle];
                    }

                    if (field === 'all') {
                        // Create a temporary div to extract only visible text content
                        const tempDiv = document.createElement('div');

                        // Only copy the text content from specific elements we want to search
                        const caseNumber = card.querySelector('h3')?.textContent || '';
                        const clientName = card.querySelector('p:nth-of-type(1)')?.textContent || '';
                        const court = card.querySelector('p:nth-of-type(2)')?.textContent || '';
                        const notes = card.querySelector('p:nth-of-type(3)')?.textContent ||
                            card.querySelector('.notes-container p')?.textContent || '';

                        tempDiv.textContent = caseNumber + ' ' + clientName + ' ' + court + ' ' + notes;

                        // Search in the extracted text content
                        const cardText = tempDiv.textContent.toLowerCase();
                        match = cardText.includes(query);

                        if (match) {
                            // Highlight matches in specific elements only
                            highlightMatches(card.querySelector('h3'), query);
                            highlightMatches(card.querySelector('p:nth-of-type(1)'), query);
                            highlightMatches(card.querySelector('p:nth-of-type(2)'), query);
                            highlightMatches(card.querySelector('p:nth-of-type(3)') ||
                                card.querySelector('.notes-container p'), query);
                        }
                    } else {
                        // Search in specific field
                        let fieldElement;

                        switch (field) {
                            case 'case_number':
                                fieldElement = card.querySelector('h3');
                                break;
                            case 'client_name':
                                fieldElement = card.querySelector('p:nth-of-type(1)');
                                break;
                            case 'court':
                                fieldElement = card.querySelector('p:nth-of-type(2)');
                                break;
                            case 'notes':
                                fieldElement = card.querySelector('p:nth-of-type(3)') ||
                                    card.querySelector('.notes-container p');
                                break;
                        }

                        if (fieldElement && fieldElement.textContent.toLowerCase().includes(query)) {
                            match = true;
                            highlightMatches(fieldElement, query);
                        }
                    }

                    // Show or hide card based on match
                    card.style.display = match ? 'block' : 'none';

                    if (match) resultsFound++;
                });

                // Update search results count
                const resultsCountEl = document.getElementById('search-results-count');
                if (resultsCountEl) {
                    if (resultsFound > 0) {
                        resultsCountEl.textContent = `Found ${resultsFound} case${resultsFound !== 1 ? 's' : ''} matching "${query}"`;
                    } else {
                        resultsCountEl.textContent = '';
                    }
                }

                // Show no results message if needed
                const noResultsMsg = document.querySelector('.no-results');
                if (noResultsMsg) noResultsMsg.remove();

                if (resultsFound === 0) {
                    const noResults = document.createElement('div');
                    noResults.className = 'no-results';
                    noResults.textContent = `No cases found matching "${query}" in ${field === 'all' ? 'any field' : field.replace('_', ' ')}.`;
                    document.querySelector('.cases-container').appendChild(noResults);
                }

                // After search is complete, re-apply current sorting if any
                const currentSort = document.getElementById('sort-select').value;
                if (currentSort !== 'default') {
                    // Trigger the change event to re-sort visible cards
                    const event = new Event('change');
                    document.getElementById('sort-select').dispatchEvent(event);
                }
            }

            // Function to reset search
            function resetSearch() {
                // Remove search-active class from body
                document.body.classList.remove('search-active');

                // Clear search results count
                const resultsCountEl = document.getElementById('search-results-count');
                if (resultsCountEl) {
                    resultsCountEl.textContent = '';
                }

                // Restore all cards to original state
                allCaseCards.forEach(card => {
                    const cardTitle = card.querySelector('h3')?.textContent || '';
                    if (cardTitle && originalCards[cardTitle]) {
                        card.innerHTML = originalCards[cardTitle];
                        card.style.display = 'block';
                    }
                });

                // Remove no results message if present
                const noResultsMsg = document.querySelector('.no-results');
                if (noResultsMsg) noResultsMsg.remove();

                // Reset to default tab view
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('active');
                });
                document.querySelector('[data-tab="all-cases"]').classList.add('active');

                document.querySelectorAll('.cases-section').forEach(section => {
                    section.classList.remove('active');
                });
                document.getElementById('all-cases').classList.add('active');

                // Re-apply current sorting if any
                const currentSort = document.getElementById('sort-select').value;
                if (currentSort !== 'default') {
                    // Trigger the change event to re-sort
                    const event = new Event('change');
                    document.getElementById('sort-select').dispatchEvent(event);
                }
            }

            // Event listeners
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                performSearch();
            });

            // Auto-reset when search input is cleared
            searchInput.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    resetSearch();
                }
            });

            // Reset button click
            resetButton.addEventListener('click', function() {
                searchInput.value = '';
                resetSearch();
            });

            // Function to highlight matching text
            function highlightMatches(element, query) {
                if (!element) return;

                const innerHTML = element.innerHTML;
                const index = element.textContent.toLowerCase().indexOf(query.toLowerCase());

                if (index >= 0) {
                    const length = query.length;
                    const textContent = element.textContent;
                    const beforeMatch = textContent.substring(0, index);
                    const match = textContent.substring(index, index + length);
                    const afterMatch = textContent.substring(index + length);

                    // If the element has child nodes, we need a more complex approach
                    if (element.childNodes.length > 1) {
                        // This is a simplified approach - for complex nested elements
                        // a more sophisticated text node traversal would be needed
                        const escapedMatch = escapeRegExp(match);
                        const regex = new RegExp(escapedMatch, 'gi');
                        element.innerHTML = innerHTML.replace(regex,
                            match => `<span class="highlight">${match}</span>`);
                    } else {
                        element.innerHTML = beforeMatch +
                            '<span class="highlight">' + match + '</span>' +
                            afterMatch;
                    }
                }
            }

            // Helper function to escape special characters in regex
            function escapeRegExp(string) {
                return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            }
        });


        // Sorting functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sortSelect = document.getElementById('sort-select');

            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    const sortValue = this.value;

                    // Get all case sections
                    const caseSections = document.querySelectorAll('.cases-section');

                    // Apply sorting to each section
                    caseSections.forEach(section => {
                        const caseCards = Array.from(section.querySelectorAll('.case-card'));

                        // Sort the case cards based on the selected option
                        caseCards.sort((a, b) => {
                            switch (sortValue) {
                                case 'client_asc':
                                    return compareText(a, b, 'p:nth-of-type(1)', true);
                                case 'client_desc':
                                    return compareText(a, b, 'p:nth-of-type(1)', false);
                                case 'case_asc':
                                    return compareText(a, b, 'h3', true);
                                case 'case_desc':
                                    return compareText(a, b, 'h3', false);
                                case 'court_asc':
                                    return compareText(a, b, 'p:nth-of-type(2)', true);
                                case 'court_desc':
                                    return compareText(a, b, 'p:nth-of-type(2)', false);
                                case 'date_asc':
                                    return compareDates(a, b, true);
                                case 'date_desc':
                                    return compareDates(a, b, false);
                                default:
                                    return 0; // Default order (no sorting)
                            }
                        });

                        // Re-append the sorted cards to the container
                        const container = section.querySelector('.cases-container');
                        if (container) {
                            caseCards.forEach(card => {
                                container.appendChild(card);
                            });
                        }
                    });
                });
            }

            // Helper function to compare text content of elements
            function compareText(cardA, cardB, selector, ascending) {
                const textA = (cardA.querySelector(selector)?.textContent || '').trim().toLowerCase();
                const textB = (cardB.querySelector(selector)?.textContent || '').trim().toLowerCase();

                // Extract actual text from elements that might contain labels
                const valueA = textA.includes(':') ? textA.split(':')[1].trim() : textA;
                const valueB = textB.includes(':') ? textB.split(':')[1].trim() : textB;

                if (ascending) {
                    return valueA.localeCompare(valueB);
                } else {
                    return valueB.localeCompare(valueA);
                }
            }

            // Helper function to compare dates
            // Note: This assumes there's a date attribute or we extract it from the case number
            function compareDates(cardA, cardB, ascending) {
                // Try to find date attributes first
                let dateA = cardA.getAttribute('data-date');
                let dateB = cardB.getAttribute('data-date');

                // If no date attributes, try to extract from case number or use ID as fallback
                if (!dateA || !dateB) {
                    // Use case ID as a proxy for date (assuming newer cases have higher IDs)
                    const idA = cardA.getAttribute('data-id') || '0';
                    const idB = cardB.getAttribute('data-id') || '0';

                    if (ascending) {
                        return parseInt(idA) - parseInt(idB);
                    } else {
                        return parseInt(idB) - parseInt(idA);
                    }
                }

                // Compare actual dates if available
                const timeA = new Date(dateA).getTime();
                const timeB = new Date(dateB).getTime();

                if (ascending) {
                    return timeA - timeB;
                } else {
                    return timeB - timeA;
                }
            }
        });
    </script>


</body>

</html>