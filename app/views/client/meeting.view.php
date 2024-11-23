
<div class="body-container">

    <div class="add">
        <button class="add-button">
            <i class="bx bx-calendar"></i> Request Meeting
        </button>
    </div>

    <!-- Request Meeting Form Section -->
    <div id="request-meeting-section" class="request-meeting-section">
        <h2>Request a Meeting</h2>
        <form action="requestMeeting.php" method="post" class="request-meeting-form">
            <label for="meeting-date">Meeting Date:</label>
            <input type="date" id="meeting-date" name="meeting-date" required>

            <label for="meeting-time">Meeting Time:</label>
            <input type="time" id="meeting-time" name="meeting-time" required>

            <label for="meeting-purpose">Purpose:</label>
            <textarea id="meeting-purpose" name="meeting-purpose" required></textarea>

            <label for="meeting-comments">Comments:</label>
            <textarea id="meeting-comments" name="meeting-comments" required></textarea>

            <button type="submit" >Submit</button>
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
                <?php
                // Example data. Replace with your database logic.
                $meetingHistory = [
                    ['date' => '2024-11-01', 'time' => '10:00 AM', 'purpose' => 'Project Discussion', 'comments' => 'Discuss project scope', 'status' => 'Accepted'],
                    ['date' => '2024-11-05', 'time' => '02:00 PM', 'purpose' => 'Budget Meeting', 'comments' => 'Review budget allocation', 'status' => 'Pending'],
                    ['date' => '2024-11-10', 'time' => '09:00 AM', 'purpose' => 'Client Feedback', 'comments' => 'Gather client feedback on project', 'status' => 'Rejected'],
                ];

                foreach ($meetingHistory as $index => $meeting) {
                    // Assign class based on meeting status
                    $statusClass = '';
                    switch ($meeting['status']) {
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

                    echo "<tr>
                        <td>" . ($index + 1) . "</td>
                        <td>{$meeting['date']}</td>
                        <td>{$meeting['time']}</td>
                        <td>{$meeting['purpose']}</td>
                        <td>{$meeting['comments']}</td>
                        <td class='{$statusClass}'>{$meeting['status']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>


