<!-- <?php
        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>';
        ?> -->
<!-- <?php
// Debug the meeting variable
var_dump(isset($meetings) ? $meetings : 'Cases variable not set');
?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- this is imported to use icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/client/meeting.css">
</head>

<body>

    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>

    <div class="body-container">

        <!-- Request Meeting Form Section -->
        <div id="request-meeting-section" class="request-meeting-section">
            <h2>Request a Meeting</h2>
            <form action="<?= ROOT ?>/meetingclient/requestMeeting" method="post" class="request-meeting-form">
                <label for="meeting-date">Meeting Date:</label>
                <input type="date" id="meeting-date" name="meeting_date" required>

                <label for="meeting-time">Meeting Time:</label>
                <input type="time" id="meeting-time" name="meeting_time" required>

                <label for="meeting-purpose">Purpose:</label>
                <textarea id="meeting-purpose" name="meeting_purpose" required></textarea>

                <label for="meeting-comments">Comments:</label>
                <textarea id="meeting-comments" name="meeting_comments" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>

        <!-- Meeting History Section -->
        <div id="meeting-history-section" class="meeting-history-section">
            <h2>Meeting History</h2>
            <table class="body-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Purpose</th>
                        <th>Comments</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($meetings)) : ?>
                        <?php foreach ($meetings as $index => $meeting) : ?>
                            <?php
                            // Determine status class dynamically
                            $statusClass = '';
                            switch ($meeting->meeting_status) {
                                case 'Accepted':
                                    $statusClass = 'accepted';
                                    break;
                                case 'Pending':
                                    $statusClass = 'pending';
                                    break;
                                case 'Rejected':
                                    $statusClass = 'rejected';
                                    break;
                            }
                            ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($meeting->meeting_date) ?></td>
                                <td><?= htmlspecialchars($meeting->meeting_time) ?></td>
                                <td><?= htmlspecialchars($meeting->meeting_purpose) ?></td>
                                <td><?= htmlspecialchars($meeting->meeting_comments) ?></td>
                                <td class="<?= $statusClass ?>"><?= htmlspecialchars($meeting->meeting_status) ?></td>
                            </tr>

                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">No meeting history available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>