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
        
        /* Filter and sort container styles */
        .filter-sort-container {
            display: flex;
            justify-content: space-between;
            margin: 15px 0;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .filter-container, .sort-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .filter-container select, .sort-container select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
            font-size: 14px;
        }
        
        .filter-container button {
            padding: 8px 12px;
            background-color: #1d1b31;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        
        .filter-container button:hover {
            background-color: #3e3b5d;
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
                    
                    <!-- Add filter and sort container -->
                    <div class="filter-sort-container">
                        <div class="filter-container">
                            <select id="current-status-filter">
                                <option value="all">All Statuses</option>
                                <option value="pending">Pending</option>
                                <option value="overdue">Overdue</option>
                            </select>
                            
                            <select id="current-date-filter">
                                <option value="all">All Dates</option>
                                <option value="today">Due Today</option>
                                <option value="week">Due This Week</option>
                                <option value="month">Due This Month</option>
                                <option value="overdue">Overdue</option>
                            </select>
                            
                            <button onclick="filterCurrentTasks()">Apply Filters</button>
                            <button onclick="resetCurrentFilters()">Reset</button>
                        </div>
                        
                        <div class="sort-container">
                            <label for="current-sort">Sort by:</label>
                            <select id="current-sort" onchange="sortCurrentTasks()">
                                <option value="name-asc">Task Name (A-Z)</option>
                                <option value="name-desc">Task Name (Z-A)</option>
                                <option value="date-asc">Deadline (Earliest First)</option>
                                <option value="date-desc">Deadline (Latest First)</option>
                                <option value="duration-asc">Duration (Shortest First)</option>
                                <option value="duration-desc">Duration (Longest First)</option>
                            </select>
                        </div>
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
                    
                    <!-- Add filter and sort container for history -->
                    <div class="filter-sort-container">
                        <div class="filter-container">
                            <select id="history-status-filter">
                                <option value="all">All Statuses</option>
                                <option value="completed">Completed</option>
                                <option value="overdue">Overdue</option>
                            </select>
                            
                            <select id="history-time-filter">
                                <option value="all">All Time</option>
                                <option value="week">Last Week</option>
                                <option value="month">Last Month</option>
                                <option value="quarter">Last 3 Months</option>
                            </select>
                            
                            <button onclick="filterHistoryTasks()">Apply Filters</button>
                            <button onclick="resetHistoryFilters()">Reset</button>
                        </div>
                        
                        <div class="sort-container">
                            <label for="history-sort">Sort by:</label>
                            <select id="history-sort" onchange="sortHistoryTasks()">
                                <option value="name-asc">Task Name (A-Z)</option>
                                <option value="name-desc">Task Name (Z-A)</option>
                                <option value="date-asc">Assigned Date (Oldest First)</option>
                                <option value="date-desc">Assigned Date (Newest First)</option>
                                <option value="time-asc">Time Taken (Shortest First)</option>
                                <option value="time-desc">Time Taken (Longest First)</option>
                            </select>
                        </div>
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

        // Filter functionality for current tasks
        function filterCurrentTasks() {
            const statusFilter = document.getElementById("current-status-filter").value;
            const dateFilter = document.getElementById("current-date-filter").value;
            const rows = document.querySelectorAll("#current-tasks-table tbody tr");
            let visibleCount = 0;
            
            rows.forEach(row => {
                // Skip the "No pending tasks" row if it exists
                if (row.cells.length === 1 && row.cells[0].colSpan === 5) {
                    row.style.display = "none";
                    return;
                }
                
                let showRow = true;
                const deadlineCell = row.cells[2];
                const durationCell = row.cells[3];
                const isOverdue = deadlineCell.classList.contains('overdue');
                
                // Apply status filter
                if (statusFilter === 'overdue' && !isOverdue) {
                    showRow = false;
                } else if (statusFilter === 'pending' && isOverdue) {
                    showRow = false;
                }
                
                // Apply date filter
                if (showRow && dateFilter !== 'all') {
                    const deadlineDate = new Date(deadlineCell.textContent.trim());
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    
                    if (dateFilter === 'today') {
                        const tomorrow = new Date(today);
                        tomorrow.setDate(tomorrow.getDate() + 1);
                        showRow = deadlineDate >= today && deadlineDate < tomorrow;
                    } else if (dateFilter === 'week') {
                        const nextWeek = new Date(today);
                        nextWeek.setDate(nextWeek.getDate() + 7);
                        showRow = deadlineDate >= today && deadlineDate < nextWeek;
                    } else if (dateFilter === 'month') {
                        const nextMonth = new Date(today);
                        nextMonth.setMonth(nextMonth.getMonth() + 1);
                        showRow = deadlineDate >= today && deadlineDate < nextMonth;
                    } else if (dateFilter === 'overdue') {
                        showRow = deadlineDate < today;
                    }
                }
                
                row.style.display = showRow ? "" : "none";
                if (showRow) visibleCount++;
            });
            
            // Show or hide the "no results" message
            document.getElementById("current-no-results").style.display = 
                visibleCount === 0 ? "block" : "none";
        }

        // Filter functionality for history tasks
        function filterHistoryTasks() {
            const statusFilter = document.getElementById("history-status-filter").value;
            const timeFilter = document.getElementById("history-time-filter").value;
            const rows = document.querySelectorAll("#history-tasks-table tbody tr");
            let visibleCount = 0;
            
            rows.forEach(row => {
                let showRow = true;
                const statusCell = row.cells[3];
                const assignedDateCell = row.cells[1];
                const status = statusCell.textContent.trim().toLowerCase();
                
                // Apply status filter
                if (statusFilter === 'completed' && status !== 'completed') {
                    showRow = false;
                } else if (statusFilter === 'overdue' && status !== 'incomplete') {
                    showRow = false;
                }
                
                // Apply time filter
                if (showRow && timeFilter !== 'all') {
                    const assignedDate = new Date(assignedDateCell.textContent.trim());
                    const today = new Date();
                    
                    if (timeFilter === 'week') {
                        const lastWeek = new Date(today);
                        lastWeek.setDate(lastWeek.getDate() - 7);
                        showRow = assignedDate >= lastWeek;
                    } else if (timeFilter === 'month') {
                        const lastMonth = new Date(today);
                        lastMonth.setMonth(lastMonth.getMonth() - 1);
                        showRow = assignedDate >= lastMonth;
                    } else if (timeFilter === 'quarter') {
                        const lastQuarter = new Date(today);
                        lastQuarter.setMonth(lastQuarter.getMonth() - 3);
                        showRow = assignedDate >= lastQuarter;
                    }
                }
                
                row.style.display = showRow ? "" : "none";
                if (showRow) visibleCount++;
            });
            
            // Show or hide the "no results" message
            document.getElementById("history-no-results").style.display = 
                visibleCount === 0 ? "block" : "none";
        }

        // Reset filters for current tasks
        function resetCurrentFilters() {
            document.getElementById("current-status-filter").value = "all";
            document.getElementById("current-date-filter").value = "all";
            document.getElementById("current-task-search").value = "";
            
            // Reset table display
            const rows = document.querySelectorAll("#current-tasks-table tbody tr");
            rows.forEach(row => {
                row.style.display = "";
            });
            
            // Hide the "no results" message
            document.getElementById("current-no-results").style.display = "none";
        }

        // Reset filters for history tasks
        function resetHistoryFilters() {
            document.getElementById("history-status-filter").value = "all";
            document.getElementById("history-time-filter").value = "all";
            document.getElementById("history-task-search").value = "";
            
            // Reset table display
            const rows = document.querySelectorAll("#history-tasks-table tbody tr");
            rows.forEach(row => {
                row.style.display = "";
            });
            
            // Hide the "no results" message
            document.getElementById("history-no-results").style.display = "none";
        }

        // Sort functionality for current tasks
        function sortCurrentTasks() {
            const sortOption = document.getElementById("current-sort").value;
            const tbody = document.querySelector("#current-tasks-table tbody");
            const rows = Array.from(tbody.querySelectorAll("tr"));
            
            // Skip the "No pending tasks" row if it exists
            const contentRows = rows.filter(row => !(row.cells.length === 1 && row.cells[0].colSpan === 5));
            
            contentRows.sort((a, b) => {
                switch (sortOption) {
                    case "name-asc":
                        return a.cells[0].textContent.localeCompare(b.cells[0].textContent);
                    case "name-desc":
                        return b.cells[0].textContent.localeCompare(a.cells[0].textContent);
                    case "date-asc":
                        return new Date(a.cells[2].textContent) - new Date(b.cells[2].textContent);
                    case "date-desc":
                        return new Date(b.cells[2].textContent) - new Date(a.cells[2].textContent);
                    case "duration-asc":
                        return parseInt(a.cells[3].textContent) - parseInt(b.cells[3].textContent);
                    case "duration-desc":
                        return parseInt(b.cells[3].textContent) - parseInt(a.cells[3].textContent);
                    default:
                        return 0;
                }
            });
            
            // Clear the table and re-add the sorted rows
            while (tbody.firstChild) {
                tbody.removeChild(tbody.firstChild);
            }
            
            contentRows.forEach(row => {
                tbody.appendChild(row);
            });
            
            // Add back the "No pending tasks" row if it exists
            const noTasksRow = rows.find(row => row.cells.length === 1 && row.cells[0].colSpan === 5);
            if (noTasksRow && contentRows.length === 0) {
                tbody.appendChild(noTasksRow);
            }
        }

        // Sort functionality for history tasks
        function sortHistoryTasks() {
            const sortOption = document.getElementById("history-sort").value;
            const tbody = document.querySelector("#history-tasks-table tbody");
            const rows = Array.from(tbody.querySelectorAll("tr"));
            
            rows.sort((a, b) => {
                switch (sortOption) {
                    case "name-asc":
                        return a.cells[0].textContent.localeCompare(b.cells[0].textContent);
                    case "name-desc":
                        return b.cells[0].textContent.localeCompare(a.cells[0].textContent);
                    case "date-asc":
                        return new Date(a.cells[1].textContent) - new Date(b.cells[1].textContent);
                    case "date-desc":
                        return new Date(b.cells[1].textContent) - new Date(a.cells[1].textContent);
                    case "time-asc":
                        return parseInt(a.cells[2].textContent) - parseInt(b.cells[2].textContent);
                    case "time-desc":
                        return parseInt(b.cells[2].textContent) - parseInt(a.cells[2].textContent);
                    default:
                        return 0;
                }
            });
            
            // Clear the table and re-add the sorted rows
            while (tbody.firstChild) {
                tbody.removeChild(tbody.firstChild);
            }
            
            rows.forEach(row => {
                tbody.appendChild(row);
            });
        }
    </script>
</body>

</html>

<!-- 
<tbody>
    <?php foreach ($completedTasks as $task): ?>
        <?php
            $assigned = new DateTime($task->assignedDate);
            $completed = new DateTime($task->completedDate ?? $task->deadlineDate);
            $interval = $assigned->diff($completed);
            $days = $interval->days;

            // No need to explode if already an array
            $tagsArray = $task->tags; 
        ?>
        <tr onclick="viewTaskDetails(<?= $task->taskID ?>)">
            <td><?= htmlspecialchars($task->name) ?></td>
            <td><?= htmlspecialchars($task->assignedDate) ?></td>
            <td><?= $days . ' day(s)' ?></td>
            <td class="<?= $task->status === 'completed' ? 'completed' : 'incomplete' ?>">
                <?= ucfirst($task->status) ?>
            </td>
            <td>
                <?php foreach ($tagsArray as $tag): ?>
                    <span class="tag"><?= htmlspecialchars(trim($tag)) ?></span>
                <?php endforeach; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody> -->
