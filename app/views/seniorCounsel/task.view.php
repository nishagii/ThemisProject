<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/task.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    
    <div class="parent-container home-section">
        <h1 class="task-heading">
            Task Management
        </h1>

       
        <div class="add">
            <a href="<?= ROOT ?>/addTask">
                <button class="add-button">
                    <i class="bx bx-plus"></i> New Task 
                </button>
            </a>
        </div>
        <div class="counters-container">
            <div class="counter total" id="total-counter">
                <div class="counter-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <strong>Total No of Tasks Assigned:</strong>
                <span class="total-users"><?= $totalCount ?? 0 ?></span>
            </div>

            <div class="individual">
                <div class="counter active" id="active-counter">
                    <div class="counter-icon">
                        <i class="fas fa-spinner"></i>
                    </div>
                    <h3>Active Tasks</h3>
                    <span><?= $pendingCount[0]->count ?? 0 ?></span>
                </div>

                <div class="counter completed" id="completed-counter">
                    <div class="counter-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Completed Tasks</h3>
                    <span><?= $completedCount[0]->count ?? 0 ?></span>
                </div>

                <div class="counter incomplete" id="incomplete-counter">
                    <div class="counter-icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <h3>Overdue Tasks</h3>
                    <span><?= $overdueCount[0]->count ?? 0 ?></span>
                </div>
            </div>
        </div>

        

        <div class="task-table-container">
               
            <div class="search-container">
                <input type="text" id="task-search" placeholder="Search tasks by name, assignee, priority...">
                <button onclick="searchTasks()"><i class="fas fa-search"></i> Search</button>
            </div>
            
            
            <table class="task-table" id="task-table">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Assigned To</th>
                        <th>Deadline Date</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th> </th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($task as $t): ?>
                    <tr onclick="viewTaskDetails(<?= $t->taskID ?>)">
                        <td><?= htmlspecialchars($t->name) ?></td>
                        <td><?= htmlspecialchars($t->assigneeName) ?></td>
                        <div class="deadline"><td><?= htmlspecialchars($t->deadlineDate) ?></td></div>
                        <td><?= htmlspecialchars($t->priority) ?></td>
                        <td class="status" 
                            data-taskid="<?= $t->taskID ?>" 
                            data-deadlinedate="<?= $t->deadlineDate ?>" 
                            data-deadlinetime="<?= $t->deadlineTime ?>" 
                            data-status="<?= $t->status ?>"
                            data-original-status="<?= $t->status ?>">
                        </td>

                        <td>
                            <?php $disabled = (strtolower($t->status) === 'completed' || strtolower($t->status) === 'overdue'); ?>
                            
                            <a 
                                href="<?= $disabled ? 'javascript:void(0);' : ROOT . '/tasklawyer/editTask/' . $t->taskID ?>" 
                                class="edit-btn <?= $disabled ? 'disabled' : '' ?>" 
                                onclick="<?= $disabled ? 'event.preventDefault();' : 'event.stopPropagation();' ?>"
                            >
                                <i class="fas fa-edit"></i>
                            </a>

                            <a 
                                href="javascript:void(0);" 
                                class="delete-btn <?= $disabled ? 'disabled' : '' ?>" 
                                onclick="<?= $disabled ? 'event.preventDefault();' : 'event.stopPropagation(); confirmDelete(' . $t->taskID . ');' ?>"
                            >
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div id="no-results" class="no-results">
                No tasks found matching your search criteria.
            </div>
        </div>
    </div>

    <script>
        document.getElementById("total-counter").addEventListener("click", () => {
            document.getElementById("task-table").scrollIntoView({ behavior: "smooth" });
        });

        document.getElementById("total-counter").addEventListener("click", () => {
            const rows = document.querySelectorAll(".task-table tbody tr");
            rows.forEach(row => {
                row.style.display = ""; 
            });
            document.getElementById("no-results").style.display = "none";
        });

        document.getElementById("active-counter").addEventListener("click", () => {
            const rows = document.querySelectorAll(".task-table tbody tr");
            let visibleCount = 0;
            
            rows.forEach(row => {
                const statusCell = row.querySelector(".status");
                const status = statusCell.dataset.originalStatus.toLowerCase();

                if (status === "pending") {
                    row.style.display = ""; 
                    visibleCount++;
                } else {
                    row.style.display = "none"; 
                }
            });

            
            document.getElementById("no-results").style.display = visibleCount === 0 ? "block" : "none";
            
           
            document.getElementById("task-table").scrollIntoView({ behavior: "smooth" });
        });

        document.getElementById("completed-counter").addEventListener("click", () => {
            const rows = document.querySelectorAll(".task-table tbody tr");
            let visibleCount = 0;

            rows.forEach(row => {
                const statusCell = row.querySelector(".status");
                if (statusCell && statusCell.dataset.status === "completed") {
                    row.style.display = "";
                    visibleCount++;
                } else {
                    row.style.display = "none";
                }
            });
            
            document.getElementById("no-results").style.display = visibleCount === 0 ? "block" : "none";
            document.getElementById("task-table").scrollIntoView({ behavior: "smooth" });
        });

        document.getElementById("incomplete-counter").addEventListener("click", () => {
            const rows = document.querySelectorAll(".task-table tbody tr");
            let visibleCount = 0;

            rows.forEach(row => {
                const statusCell = row.querySelector(".status");
                if (statusCell && statusCell.textContent.trim().toLowerCase() === "overdue") {
                    row.style.display = "";
                    visibleCount++;
                } else {
                    row.style.display = "none";
                }
            });
            
            document.getElementById("no-results").style.display = visibleCount === 0 ? "block" : "none";
            document.getElementById("task-table").scrollIntoView({ behavior: "smooth" });
        });

        
        function searchTasks() {
            const searchTerm = document.getElementById("task-search").value.toLowerCase();
            const rows = document.querySelectorAll(".task-table tbody tr");
            let visibleCount = 0;

            rows.forEach(row => {
                const taskName = row.cells[0].textContent.toLowerCase();
                const assignee = row.cells[1].textContent.toLowerCase();
                const deadline = row.cells[2].textContent.toLowerCase();
                const priority = row.cells[3].textContent.toLowerCase();
                const status = row.querySelector(".status").textContent.toLowerCase();

                if (
                    taskName.includes(searchTerm) ||
                    assignee.includes(searchTerm) ||
                    deadline.includes(searchTerm) ||
                    priority.includes(searchTerm) ||
                    status.includes(searchTerm)
                ) {
                    row.style.display = "";
                    visibleCount++;
                } else {
                    row.style.display = "none";
                }
            });

           
            document.getElementById("no-results").style.display = visibleCount === 0 ? "block" : "none";
        }

        
        document.getElementById("task-search").addEventListener("keyup", function(event) {
            if (event.key === "Enter") {
                searchTasks();
            }
        });

       
        document.getElementById("task-search").addEventListener("input", function() {
            if (this.value === "") {
                const rows = document.querySelectorAll(".task-table tbody tr");
                rows.forEach(row => {
                    row.style.display = "";
                });
                document.getElementById("no-results").style.display = "none";
            }
        });

        function viewTaskDetails(taskId) {
           
            window.location.href = "<?= ROOT ?>/tasklawyer/details/" + taskId;
        }

        function confirmDelete(taskID) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this task? This action cannot be undone!",
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
                   
                    window.location.href = `<?= ROOT ?>/tasklawyer/deleteTask/${taskID}`;
                }
            });
        }

        document.querySelectorAll('.status').forEach(cell => {
            const taskID = cell.dataset.taskid;
            const deadlineDate = cell.dataset.deadlinedate;
            const deadlineTime = cell.dataset.deadlinetime;
            const originalStatus = cell.dataset.status;

            const deadline = new Date(`${deadlineDate}T${deadlineTime}`);
            const now = new Date();

            if (originalStatus === 'completed') {
                cell.textContent = 'Completed';
                cell.style.color = 'green';
            } else if (now > deadline && originalStatus !== 'overdue') {
                cell.textContent = 'Overdue';
                cell.style.color = 'red';

               
                fetch(`<?= ROOT ?>/tasklawyer/overdueTask/${taskID}`, {
                    method: 'POST',
                })
                .then(response => {
                    if (!response.ok) throw new Error("Failed to update task.");
                    return response.json();
                })
                .then(data => {
                    console.log(`Task ${taskID} marked as overdue.`);
                })
                .catch(error => {
                    console.error("Error updating task status:", error);
                });
            } else {
                cell.textContent = originalStatus.charAt(0).toUpperCase() + originalStatus.slice(1);
                cell.style.color = 'orange';
            }
        });

        function sortTasks() {
            const sortValue = document.getElementById("sort-tasks").value;
            const table = document.querySelector(".task-table tbody");
            const rows = Array.from(table.querySelectorAll("tr"));

            rows.sort((a, b) => {
                const getText = (el, index) => el.cells[index].textContent.trim().toLowerCase();
                const getDate = (el, index) => new Date(el.cells[index].textContent.trim());
                const getPriorityValue = (priority) => {
                   
                    if (priority === "high") return 3;
                    if (priority === "medium") return 2;
                    if (priority === "low") return 1;
                    return 0;
                };

                switch (sortValue) {
                    case "deadline-desc":
                        return getDate(b, 2) - getDate(a, 2);
                    case "deadline-asc":
                        return getDate(a, 2) - getDate(b, 2);
                    case "priority-asc":
                        return getPriorityValue(getText(a, 3)) - getPriorityValue(getText(b, 3));
                    case "priority-desc":
                        return getPriorityValue(getText(b, 3)) - getPriorityValue(getText(a, 3));
                    case "name-asc":
                        return getText(a, 0).localeCompare(getText(b, 0));
                    case "name-desc":
                        return getText(b, 0).localeCompare(getText(a, 0));
                }
            });

            table.innerHTML = '';
            rows.forEach(row => table.appendChild(row));
        }
    </script>
</body>
</html>