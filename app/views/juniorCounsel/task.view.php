<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/juniorCounsel/task.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Add style for clickable rows */
        table tbody tr {
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        table tbody tr:hover {
            background-color: #f5f5f5;
        }
        
        /* Ensure "Done" button doesn't trigger the row click */
        .done, .done-overdue {
            position: relative;
            z-index: 2;
        }
    </style>   
</head>

<body>

<?php include('component/bigNav.view.php'); ?>
<?php include('component/smallNav1.view.php'); ?>
<?php include('component/sidebar.view.php'); ?>

<div class="home-section">
<div class="center">
        <div class="tab-container">
            <div class="tab_box">
                <button class="tab_btn active">Current Tasks</button>
                <button class="tab_btn">Task History</button>
                <div class="line"></div>
            </div>
            <div class="content_box">
                <div class="content active">
                    <h2>Current Tasks</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Assigned Date</th>
                                <th>Deadline Date</th>
                                <th>Duration</th>
                                <th>Done</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $hasPendingTasks = false;
                            foreach ($tasks as $task): 
                                if ($task->status !== 'pending') continue;
                                $hasPendingTasks = true;

                                $assigned = new DateTime($task->assignedDate);
                                $deadline = new DateTime($task->deadlineDate);
                                $today = new DateTime();
                                $interval = $assigned->diff($deadline);
                                $days = $interval->days;
                                $remaining = $today->diff($deadline)->format('%r%a');
                                $isOverdue = ($remaining < 0);
                            ?>
                                <tr onclick="viewTaskDetails(<?= $task->taskID ?>)">
                                    <td><?= htmlspecialchars($task->name) ?></td>
                                    <td><?= htmlspecialchars($task->assignedDate) ?></td>
                                    <td class="<?= $isOverdue ? 'overdue' : 'deadline-date' ?>">
                                        <?= htmlspecialchars($task->deadlineDate) ?>
                                    </td>
                                    <td class="<?= $isOverdue ? 'overdue' : '' ?>">
                                        <?= $isOverdue ? $remaining . ' day(s)' : $days . ' day(s)' ?>
                                    </td>
                                    <td>
                                        <a href="<?= ROOT ?>/task/complete/<?= $task->taskID ?>" 
                                        class="<?= $isOverdue ? 'done-overdue' : 'done' ?>" 
                                        onclick="event.stopPropagation()">
                                            <i class='bx bx-check-circle'></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if (!$hasPendingTasks): ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; color: #888;">No pending tasks.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>


                    </table>
                </div>

                <div class="content">
                    <h2>Task History</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Assigned Date</th>
                                <th>Time Taken</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($completedTasks as $task): ?>
                                <?php
                                    // Calculate time taken
                                    $assigned = new DateTime($task->assignedDate);
                                    $completed = new DateTime($task->completedDate ?? $task->deadlineDate);
                                    $interval = $assigned->diff($completed);
                                    $days = $interval->days;
                                ?>
                                <tr onclick="viewTaskDetails(<?= $task->taskID ?>)">
                                    <td><?= htmlspecialchars($task->name) ?></td>
                                    <td><?= htmlspecialchars($task->assignedDate) ?></td>
                                    <td><?= $days . ' day(s)' ?></td>
                                    <td class="<?= $task->status === 'completed' ? 'completed' : 'incomplete' ?>">
                                        <?= ucfirst($task->status) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
    <script src="<?= ROOT ?>/assets/js/juniorCounsel/task.js"></script>
    <script>
        function viewTaskDetails(taskId) {
            // Redirect to the task details page
            window.location.href = "<?= ROOT ?>/task/details/" + taskId;
        }
    </script>
</body>
</html>