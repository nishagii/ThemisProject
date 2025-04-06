
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/juniorCounsel/task.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<?php include('component/bigNav.view.php'); ?>
<?php include('component/smallNav1.view.php'); ?>
<?php include('component/sidebar.view.php'); ?>

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
                            <?php if (!empty($tasks)): ?>
                                <?php foreach ($tasks as $task): ?>
                                    <?php
                                        // Calculate duration
                                        $assigned = new DateTime($task->assignedDate);
                                        $deadline = new DateTime($task->deadlineDate);
                                        $today = new DateTime();
                                        $interval = $assigned->diff($deadline);
                                        $days = $interval->days;

                                        // Check if overdue
                                        $remaining = $today->diff($deadline)->format('%r%a');
                                        $isOverdue = ($remaining < 0);
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($task->name) ?></td>
                                        <td><?= htmlspecialchars($task->assignedDate) ?></td>
                                        <td><?= htmlspecialchars($task->deadlineDate) ?></td>
                                        <td class="<?= $isOverdue ? 'overdue' : '' ?>">
                                            <?= $isOverdue ? $remaining . ' day(s)' : $days . ' day(s)' ?>
                                        </td>
                                        <td>
                                            <?php if ($task->status !== 'completed'): ?>
                                                <a href="<?= ROOT ?>/task/complete/<?= $task->taskID ?>" class="<?= $isOverdue ? 'done-overdue' : 'done' ?>">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            <?php else: ?>
                                                <span class="completed-btn">✔️ Completed</span>
                                            <?php endif; ?>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No current tasks assigned to you.</td>
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
                            <tr>
                                <td>Task 1</td>
                                <td>2024-11-15</td>
                                <td>5 days</td>
                                <td class="completed">Completed</td>
                            </tr>
                            <tr>
                                <td>Task 1</td>
                                <td>2024-11-15</td>
                                <td>5 days</td>
                                <td class="completed">Completed</td>
                            </tr>
                            <tr>
                                <td>Task 1</td>
                                <td>2024-11-15</td>
                                <td>5 days</td>
                                <td class="completed">Completed</td>
                            </tr>
                            <tr>
                                <td>Task 1</td>
                                <td>2024-11-15</td>
                                <td>5 days</td>
                                <td class="incomplete">Incomplete</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <script src="<?= ROOT ?>/assets/js/juniorCounsel/task.js"></script>
</body>
</html>