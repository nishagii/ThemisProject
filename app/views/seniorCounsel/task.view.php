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
</head>
<body>

    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    
    <div class="parent-container home-section">
        <h1 class="task-heading">
            Task Management
        </h1>
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

        <!-- Add Task Button -->
        <div class="add">
            <a href="<?= ROOT ?>/addTask">
                <button class="add-button">
                    <i class="bx bx-plus"></i> Assign New Task 
                </button>
            </a>
        </div>

        <div class="task-table-container">
    <table class="task-table">
        <thead>
            <tr>
                <th>Task Name</th>
                <th>Description</th>
                <th>Assigned To</th>
                <th>Deadline Date</th>
                <th>Deadline Time</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Actions</th> <!-- Added Actions Column -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($task as $t): ?>
            <tr>
                <td><?= htmlspecialchars($t->name) ?></td>
                <td><?= htmlspecialchars($t->description) ?></td>
                <td><?= htmlspecialchars($t->assigneeID) ?></td>
                <td><?= htmlspecialchars($t->deadlineDate) ?></td>
                <td><?= htmlspecialchars($t->deadlineTime) ?></td>
                <td><?= htmlspecialchars($t->priority) ?></td>
                <td><?= htmlspecialchars($t->status) ?></td>
                <td>

                    <a href="<?= ROOT ?>/tasklawyer/editTask/<?= $t->taskID ?>" class="edit-btn">Edit</a> <!-- Edit Link -->
                   
                    <a href="javascript:void(0);" class="delete-btn" onclick="confirmDelete(<?= $t->taskID; ?>)">Delete</a> <!-- Delete Link -->
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

    </div>
        <script>
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
        </script>

</body>
</html>
