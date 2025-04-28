<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS - Task Details</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/juniorCounsel/task.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/juniorCounsel/taskDetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>

    <div class="home-section">
        <div class="task-details-container">
            
            <div class="task-header">

                    <button class="action-button back-button" onclick="window.location.href='<?= ROOT ?>/task'">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                <h1><?= htmlspecialchars($task->name) ?></h1>
                
                <?php
                    $statusClass = 'status-pending';
                    $statusText = 'Pending';
                    
                    $deadline = new DateTime($task->deadlineDate);
                    $today = new DateTime();
                    $remaining = $today->diff($deadline)->format('%r%a');
                    $isOverdue = ($remaining < 0);
                    
                    if ($task->status === 'completed') {
                        $statusClass = 'status-completed';
                        $statusText = 'Completed';
                    } elseif ($isOverdue) {
                        $statusClass = 'status-overdue';
                        $statusText = 'Overdue';
                    }
                ?>
                
                <span class="status-badge <?= $statusClass ?>"><?= $statusText ?></span>
            </div>
            
            <div class="task-body">
                <div class="info-section">
                    <h2>Task Information</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Assigned Date</span>
                            <span class="info-value"><?= htmlspecialchars($task->assignedDate) ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Deadline Date</span>
                            <span class="info-value"><?= htmlspecialchars($task->deadlineDate) ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Priority</span>
                            <span class="info-value">
                                <?php
                                    $priorityClass = '';
                                    $priority = strtolower($task->priority);
                                    
                                    if ($priority === 'high') {
                                        $priorityClass = 'priority-high';
                                    } elseif ($priority === 'medium') {
                                        $priorityClass = 'priority-medium';
                                    } elseif ($priority === 'low') {
                                        $priorityClass = 'priority-low';
                                    }
                                ?>
                                <span class="priority-badge <?= $priorityClass ?>">
                                    <?php if ($priority === 'high'): ?>
                                        <i class="fas fa-exclamation-circle"></i>
                                    <?php elseif ($priority === 'medium'): ?>
                                        <i class="fas fa-dot-circle"></i>
                                    <?php else: ?>
                                        <i class="fas fa-arrow-circle-down"></i>
                                    <?php endif; ?>
                                    <?= htmlspecialchars(ucfirst($priority)) ?>
                                </span>
                            </span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Assigned By</span>
                            <span class="info-value"><?= htmlspecialchars($task->assignerName ?? 'System') ?></span>
                        </div>
                        <?php if ($task->status === 'completed' && !empty($task->completedDate)): ?>
                        <div class="info-item">
                            <span class="info-label">Completed Date</span>
                            <span class="info-value"><?= htmlspecialchars($task->completedDate) ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="info-item">
                            <span class="info-label">Time Remaining</span>
                            <span class="info-value">
                                <?php if ($task->status === 'completed'): ?>
                                    Task completed
                                <?php elseif ($isOverdue): ?>
                                    <span style="color: #dc3545;">Overdue by <?= abs($remaining) ?> day(s)</span>
                                <?php else: ?>
                                    <?= $remaining ?> day(s) remaining
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="info-section">
                    <h2>Task Description</h2>
                    <div class="description-box">
                        <?= nl2br(htmlspecialchars($task->description ?? 'No description provided.')) ?>
                    </div>

                    <?php if (!empty($task->task_doc)): ?>
                        <div class="info-section">
                            <h2>Task Document for reference</h2>
                            <div class="document-box">
                                <a class="document-link" href="<?= ROOT ?>/uploads/task_docs/<?= htmlspecialchars($task->task_doc) ?>" target="_blank">
                                    <i class="fas fa-file-alt"></i> Download
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                
                <?php if ($task->status !== 'completed' && $isOverdue): ?>
                <div class="deadline-warning overdue-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>This task is overdue. Please complete it as soon as possible or contact your supervisor if you need assistance.</div>
                </div>
                <?php elseif ($task->status !== 'completed' && $remaining <= 2): ?>
                <div class="deadline-warning">
                    <i class="fas fa-clock"></i>
                    <div>This task is due soon. Make sure to complete it before the deadline.</div>
                </div>
                <?php endif; ?>
                
                <div class="action-buttons">
                    
                    
                    <?php if ($task->status !== 'completed'): ?>
                    <button class="action-button complete-button" id="completeButton">
                        <i class="fas fa-check"></i> Mark as Complete
                    </button>
                    <?php else: ?>
                    <button class="action-button completed-button" disabled>
                        <i class="fas fa-check-circle"></i> Task Completed
                    </button>
                    <?php endif; ?>
                </div>
                
                
                <div class="completion-comments" id="completionComments">
                    <h3>Completion Comments (Optional)</h3>
                    <form id="completeTaskForm" action="<?= ROOT ?>/task/complete/<?= $task->taskID ?>" method="post">
                        <textarea name="comment" placeholder="Add any comments about your task completion (optional)"></textarea>
                        <div class="completion-comments-buttons">
                            <button type="submit" class="action-button submit-button">
                                <i class="fas fa-check"></i> Submit
                            </button>
                            <button type="button" class="action-button cancel-button" id="cancelButton">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
                
                <?php if (!empty($task->notes)): ?>
                <div class="info-section task-notes">
                    <h2>Notes</h2>
                    <div class="description-box">
                        <?= nl2br(htmlspecialchars($task->notes)) ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
       
        const completeButton = document.getElementById('completeButton');
        const completionComments = document.getElementById('completionComments');
        const cancelButton = document.getElementById('cancelButton');
        
        if (completeButton) {
            completeButton.addEventListener('click', function() {
                completionComments.style.display = 'block';
                completeButton.style.display = 'none';
            });
        }
        
        if (cancelButton) {
            cancelButton.addEventListener('click', function() {
                completionComments.style.display = 'none';
                completeButton.style.display = 'inline-flex';
            });
        }
    </script>
</body>
</html>