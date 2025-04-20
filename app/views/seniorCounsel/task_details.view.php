<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS - Task Details</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/taskView.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    
    <div class="home-section">
        <div class="task-section">
            <a href="<?= ROOT ?>/tasklawyer" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Tasks
            </a>
        
        <div class="details-container">
            <div class="task-header">
                <h1>Task Name: <?= htmlspecialchars($task->name) ?></h1>
                <?php
                    $statusClass = '';
                    switch($task->status) {
                        case 'completed':
                            $statusClass = 'status-completed';
                            break;
                        case 'overdue':
                            $statusClass = 'status-overdue';
                            break;
                        default:
                            $statusClass = 'status-pending';
                    }
                ?>
                <span class="task-status <?= $statusClass ?>"><?= ucfirst(htmlspecialchars($task->status)) ?></span>
            </div>
            
            <div class="task-info">
                <div class="left-info">
                    <div class="info-group">
                        <div class="info-label">Assigned To</div>
                        <div class="info-value"><?= htmlspecialchars($task->assigneeName) ?></div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Assigned Date</div>
                        <div class="info-value"><?= htmlspecialchars($task->assignedDate) ?></div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Assigned By</div>
                        <div class="info-value"><?= htmlspecialchars($task->assignerName ?? 'Not specified') ?></div>
                    </div>
                </div>
                
                <div class="right-info">
                    <div class="info-group">
                        <div class="info-label">Deadline</div>
                        <div class="info-value">
                            <?= htmlspecialchars($task->deadlineDate) ?> 
                            <?= !empty($task->deadlineTime) ? 'at ' . htmlspecialchars($task->deadlineTime) : '' ?>
                        </div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Priority</div>
                        <div class="info-value">
                            <?php
                                $priorityClass = '';
                                switch(strtolower($task->priority)) {
                                    case 'high':
                                        $priorityClass = 'priority-high';
                                        break;
                                    case 'medium':
                                        $priorityClass = 'priority-medium';
                                        break;
                                    case 'low':
                                        $priorityClass = 'priority-low';
                                        break;
                                }
                            ?>
                            <span class="priority-badge <?= $priorityClass ?>"><?= htmlspecialchars($task->priority) ?></span>
                        </div>
                    </div>
                    
                    <?php if(!empty($task->completedDate)): ?>
                    <div class="info-group">
                        <div class="info-label">Completed Date</div>
                        <div class="info-value"><?= htmlspecialchars($task->completedDate) ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="task-description">
                <h3>Description</h3>
                <p><?= nl2br(htmlspecialchars($task->description ?? 'No description provided.')) ?></p>
            </div>
            
            <div class="actions-container">
                <a href="<?= ROOT ?>/tasklawyer/editTask/<?= $task->taskID ?>" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Task
                </a>
                <?php if($task->status !== 'completed'): ?>
                <button class="btn btn-secondary" onclick="markAsCompleted(<?= $task->taskID ?>)">
                    <i class="fas fa-check"></i> Mark as Completed
                </button>
                <?php endif; ?>
                <button class="btn btn-danger" onclick="confirmDelete(<?= $task->taskID ?>)">
                    <i class="fas fa-trash"></i> Delete Task
                </button>
            </div>
        </div>
        
        <?php if(!empty($taskHistory)): ?>
        <div class="task-history">
            <h2>Task History</h2>
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Action</th>
                        <th>User</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($taskHistory as $history): ?>
                    <tr>
                        <td><?= htmlspecialchars($history->actionDate) ?></td>
                        <td><?= htmlspecialchars($history->actionType) ?></td>
                        <td><?= htmlspecialchars($history->userName) ?></td>
                        <td><?= htmlspecialchars($history->details) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        
        function markAsCompleted(taskID) {
            Swal.fire({
                title: 'Confirm Completion',
                text: "Mark this task as completed?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1d1b31',
                cancelButtonColor: '#93a8e3',
                confirmButtonText: 'Yes, mark as completed',
                cancelButtonText: 'Cancel',
                background: '#fafafa',
                color: '#1d1b31',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Need to implement the complete task endpoint
                    window.location.href = `<?= ROOT ?>/tasklawyer/completeTask/${taskID}`;
                }
            });
        }
    </script>
</body>
</html>