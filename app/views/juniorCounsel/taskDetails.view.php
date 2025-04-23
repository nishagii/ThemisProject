<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS - Task Details</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/juniorCounsel/task.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .task-details-container {
            padding: 30px;
            overflow: hidden;
        }

        .task-header {
            color: black;
            padding: 20px;
            position: relative;
        }

        .task-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .task-header .status-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .status-pending {
            background: #ffa500;
        }

        .status-completed {
            background: #28a745;
        }

        .status-overdue {
            background: #dc3545;
        }

        /* Priority Badge Styles */
        .priority-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            min-width: 80px;
        }

        .priority-high {
            background-color: #ffecec;
            color: #dc3545;
            border: 1px solid #ffc9c9;
        }

        .priority-medium {
            background-color: #fff8ec;
            color: #fd7e14;
            border: 1px solid #ffe5c0;
        }

        .priority-low {
            background-color: #ecf5ff;
            color: #007bff;
            border: 1px solid #c9e0ff;
        }

        .task-body {
            padding: 30px;
        }

        .info-section {
            margin-bottom: 30px;
        }

        .info-section h2 {
            margin-top: 0;
            font-size: 18px;
            color: #1d1b31;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .info-item {
            margin-bottom: 15px;
        }

        .info-label {
            font-weight: 600;
            color: #666;
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .info-value {
            color: #333;
            font-size: 16px;
        }

        .description-box {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            border-left: 4px solid #1d1b31;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .action-button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .action-button i {
            font-size: 16px;
        }

        .complete-button {
            background-color: #28a745;
            color: white;
        }

        .complete-button:hover {
            background-color: #218838;
        }

        .back-button {
            background-color: #6c757d;
            color: white;
        }

        .back-button:hover {
            background-color: #5a6268;
        }

        .completed-button {
            background-color: #007bff;
            color: white;
        }

        .completed-button:hover {
            background-color: #0069d9;
        }

        .task-notes {
            margin-top: 30px;
        }

        .notes-form textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-height: 100px;
            margin-bottom: 15px;
            font-family: inherit;
            resize: vertical;
        }

        .deadline-warning {
            margin-top: 20px;
            padding: 15px;
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            color: #856404;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .deadline-warning i {
            font-size: 20px;
        }

        .overdue-warning {
            background-color: #f8d7da;
            border-left: 4px solid #dc3545;
            color: #721c24;
        }
        
        /* Completion Comments Form Styles */
        .completion-comments {
            display: none;
            margin-top: 20px;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        
        .completion-comments h3 {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 16px;
            color: #333;
        }
        
        .completion-comments textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-height: 100px;
            margin-bottom: 15px;
            font-family: inherit;
            resize: vertical;
        }
        
        .completion-comments-buttons {
            display: flex;
            gap: 10px;
        }
        
        .submit-button {
            background-color: #28a745;
            color: white;
        }
        
        .submit-button:hover {
            background-color: #218838;
        }
        
        .cancel-button {
            background-color: #dc3545;
            color: white;
        }
        
        .cancel-button:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .action-button {
                width: 100%;
                justify-content: center;
            }
            
            .completion-comments-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>

    <div class="home-section">
        <div class="task-details-container">
            <div class="task-header">
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
                    <button class="action-button back-button" onclick="window.location.href='<?= ROOT ?>/task'">
                        <i class="fas fa-arrow-left"></i> Back to Tasks
                    </button>
                    
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
                
                <!-- Completion Comments Form -->
                <div class="completion-comments" id="completionComments">
                    <h3>Completion Comments (Optional)</h3>
                    <form id="completeTaskForm" action="<?= ROOT ?>/task/complete/<?= $task->taskID ?>" method="post">
                        <textarea name="completionComments" placeholder="Add any comments about your task completion (optional)"></textarea>
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
        // Show/hide completion comments form
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