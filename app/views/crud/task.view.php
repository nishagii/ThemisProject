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
        
        /* Search container styles */
        .search-container {
            margin: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .search-container input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 70%;
            font-size: 14px;
        }
        
        .search-container button {
            padding: 10px 15px;
            background-color: #1d1b31;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        
        .search-container button:hover {
            background-color: #3e3b5d;
        }
        
        /* No results message */
        .no-results {
            text-align: center;
            padding: 20px;
            color: #888;
            font-style: italic;
            display: none;
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
                    
                    <!-- Add search container -->
                    <div class="search-container">
                        <input type="text" id="current-task-search" placeholder="Search tasks by name, date, or duration...">
                        <button onclick="searchCurrentTasks()"><i class="fas fa-search"></i> Search</button>
                    </div>
                    
                    <table id="current-tasks-table">
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
                    
                    <!-- Add no results message -->
                    <div id="current-no-results" class="no-results">
                        No tasks found matching your search criteria.
                    </div>
                </div>

                <div class="content">
                    <h2>Task History</h2>
                    
                    <!-- Add search container for history -->
                    <div class="search-container">
                        <input type="text" id="history-task-search" placeholder="Search completed tasks by name, date, or status...">
                        <button onclick="searchHistoryTasks()"><i class="fas fa-search"></i> Search</button>
                    </div>
                    
                    <table id="history-tasks-table">
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
                    
                    <!-- Add no results message for history -->
                    <div id="history-no-results" class="no-results">
                        No tasks found matching your search criteria.
                    </div>
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
        
        // Search functionality for current tasks
        function searchCurrentTasks() {
            const searchTerm = document.getElementById("current-task-search").value.toLowerCase();
            const rows = document.querySelectorAll("#current-tasks-table tbody tr");
            let visibleCount = 0;
            
            rows.forEach(row => {
                // Skip the "No pending tasks" row if it exists
                if (row.cells.length === 1 && row.cells[0].colSpan === 5) {
                    row.style.display = "none";
                    return;
                }
                
                const taskName = row.cells[0].textContent.toLowerCase();
                const assignedDate = row.cells[1].textContent.toLowerCase();
                const deadlineDate = row.cells[2].textContent.toLowerCase();
                const duration = row.cells[3].textContent.toLowerCase();
                
                if (
                    taskName.includes(searchTerm) ||
                    assignedDate.includes(searchTerm) ||
                    deadlineDate.includes(searchTerm) ||
                    duration.includes(searchTerm)
                ) {
                    row.style.display = "";
                    visibleCount++;
                } else {
                    row.style.display = "none";
                }
            });
            
            // Show or hide the "no results" message
            document.getElementById("current-no-results").style.display = 
                visibleCount === 0 ? "block" : "none";
        }
        
        // Search functionality for task history
        function searchHistoryTasks() {
            const searchTerm = document.getElementById("history-task-search").value.toLowerCase();
            const rows = document.querySelectorAll("#history-tasks-table tbody tr");
            let visibleCount = 0;
            
            rows.forEach(row => {
                const taskName = row.cells[0].textContent.toLowerCase();
                const assignedDate = row.cells[1].textContent.toLowerCase();
                const timeTaken = row.cells[2].textContent.toLowerCase();
                const status = row.cells[3].textContent.toLowerCase();
                
                if (
                    taskName.includes(searchTerm) ||
                    assignedDate.includes(searchTerm) ||
                    timeTaken.includes(searchTerm) ||
                    status.includes(searchTerm)
                ) {
                    row.style.display = "";
                    visibleCount++;
                } else {
                    row.style.display = "none";
                }
            });
            
            // Show or hide the "no results" message
            document.getElementById("history-no-results").style.display = 
                visibleCount === 0 ? "block" : "none";
        }
        
        // Add event listeners for search input fields to search on Enter key press
        document.getElementById("current-task-search").addEventListener("keyup", function(event) {
            if (event.key === "Enter") {
                searchCurrentTasks();
            }
        });
        
        document.getElementById("history-task-search").addEventListener("keyup", function(event) {
            if (event.key === "Enter") {
                searchHistoryTasks();
            }
        });
        
        // Clear search results when input is cleared
        document.getElementById("current-task-search").addEventListener("input", function() {
            if (this.value === "") {
                const rows = document.querySelectorAll("#current-tasks-table tbody tr");
                rows.forEach(row => {
                    row.style.display = "";
                });
                document.getElementById("current-no-results").style.display = "none";
            }
        });
        
        document.getElementById("history-task-search").addEventListener("input", function() {
            if (this.value === "") {
                const rows = document.querySelectorAll("#history-tasks-table tbody tr");
                rows.forEach(row => {
                    row.style.display = "";
                });
                document.getElementById("history-no-results").style.display = "none";
            }
        });
    </script>
</body>
</html>
