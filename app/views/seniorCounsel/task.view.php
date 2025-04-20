<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/task.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- this is imported to use icons -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Add style for clickable rows */
        .task-table tbody tr {
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .task-table tbody tr:hover {
            background-color: #f5f5f5;
        }
        
        /* Ensure action buttons don't trigger the row click */
        .edit-btn, .delete-btn {
            position: relative;
            z-index: 2;
        }
    </style>
</head>
<body>

    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    
    <div class="parent-container home-section">
        <h1 class="task-heading">
            Task Management
        </h1>

        <!-- Add Task Button -->
        <div class="add">
            <a href="<?= ROOT ?>/addTask">
                <button class="add-button">
                    <i class="bx bx-plus"></i> New Task 
                </button>
            </a>
        </div>
        <div class="counters-container">
            <div class="counter total">
                <div class="counter-icon">
                    <i class="fas fa-tasks"></i> <!-- Updated icon -->
                </div>
                <strong>Total No of Tasks Assigned:</strong>
                <span class="total-users"><?= $count[0]->count ?></span>
            </div>
            <div class="individual">
                <div class="counter active">
                    <div class="counter-icon">
                        <i class="fas fa-spinner"></i> <!-- Icon for active tasks -->
                    </div>
                    <h3>Active Tasks</h3>
                    <span>50</span>
                </div>
                <div class="counter completed">
                    <div class="counter-icon">
                        <i class="fas fa-check-circle"></i> <!-- Icon for completed tasks -->
                    </div>
                    <h3>Completed Tasks</h3>
                    <span>25</span>
                </div>
                <div class="counter incomplete">
                    <div class="counter-icon">
                        <i class="fas fa-times-circle"></i> <!-- Icon for incomplete tasks -->
                    </div>
                    <h3>Incomplete Tasks</h3>
                    <span>25</span>
                </div>
            </div>
        </div>

        <div class="task-table-container">
            <table class="task-table">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Assigned To</th>
                        <th>Deadline Date</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Actions</th> <!-- Added Actions Column -->
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
                            data-status="<?= $t->status ?>">
                        </td>
                        <td>
                            <a href="<?= ROOT ?>/tasklawyer/editTask/<?= $t->taskID ?>" class="edit-btn" onclick="event.stopPropagation()"><i class="fas fa-edit"></i></a> <!-- Edit Link -->
                            <a href="javascript:void(0);" class="delete-btn" onclick="event.stopPropagation(); confirmDelete(<?= $t->taskID; ?>)"><i class="fas fa-trash"></i></a> <!-- Delete Link -->
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function viewTaskDetails(taskId) {
            // Redirect to the task details page
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
                    // Redirect to the delete action
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

                // Send API call to update status
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
    </script>
</body>
</html>