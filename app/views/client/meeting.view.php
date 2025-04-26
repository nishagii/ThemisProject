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
<style>
    .delete-btn {
        background-color: #e74c3c;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9em;
        transition: background-color 0.3s;
    }

    .delete-btn:hover {
        background-color: #c0392b;
    }

    .delete-btn.disabled {
        background-color: #95a5a6;
        cursor: not-allowed;
    }
</style>


<body>

    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>

    <div class="home-section">

        <div class="body-container">

            <!-- Request Meeting Form Section -->
            <!-- In the request meeting form section -->
            <div id="request-meeting-section" class="request-meeting-section">
                <h2>Request a Meeting</h2>
                <form action="<?= ROOT ?>/meetingclient/requestMeeting" method="post" class="request-meeting-form">
                    <label for="meeting-date">Meeting Date:</label>
                    <input type="date" id="meeting-date" name="meeting_date" min="<?= date('Y-m-d') ?>" required>

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
                            <th>Action</th>
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
                                    <td>
                                        <?php if ($meeting->meeting_status == 'Pending') : ?>
                                            <button class="delete-btn" data-id="<?= $meeting->id ?>" onclick="confirmDelete(<?= $meeting->id ?>)">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        <?php else : ?>
                                            <button class="delete-btn disabled" disabled title="Cannot delete accepted or rejected meetings">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7">No meeting history available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Add SweetAlert script for success message and delete confirmation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($_SESSION['success'])) : ?>
                Swal.fire({
                    title: 'Success!',
                    text: '<?= $_SESSION['success'] ?>',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])) : ?>
                Swal.fire({
                    title: 'Error!',
                    text: '<?= $_SESSION['error'] ?>',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        });

        function confirmDelete(meetingId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete endpoint
                    window.location.href = '<?= ROOT ?>/meetingclient/deleteMeeting/' + meetingId;
                }
            });
        }
    </script>

</body>

</html>