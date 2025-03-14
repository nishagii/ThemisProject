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
                <p>Here you can view the client meeting requests and their status. Select  buttons to filter the details </p>
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
                    <tbody>
                        <?php if (!empty($meetingDetails)): ?>
                            <?php foreach ($meetingDetails as $meeting): ?>
                                <tr>
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

                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No meetings found</td>
                                </tr>
                            <?php endif; ?>
                    </tbody>
                </table>
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
                    }
                });
        });
    });

    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            this.setAttribute('data-current', this.value);
        });
    });

    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            const status = this.dataset.status;
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const statusSelect = row.querySelector('.status-select');
                if (status === 'all' || statusSelect.value === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>