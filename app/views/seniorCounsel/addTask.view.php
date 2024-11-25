<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/task.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- this is imported to use icons -->
</head>
<body>

    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>

    <div class="form-body">

        <div class="modal" id="modal">
                        <?php if (!empty($errors)): ?>
                    <div class="error-container">
                        <?php foreach ($errors as $field => $error): ?>
                            <p><?= ucfirst($field) ?>: <?= $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            <div class="modal-header">
                <div class="title">Assign a Task</div>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="name">Task Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="form-group">
            <label for="assigneeID">Assign To:</label>
            <select id="assigneeID" name="assigneeID" required>
                <option value="" disabled selected>Select a user</option>
                <?php if ($users): ?>
                    <?php foreach ($users as $user): ?>
                                                <option value="<?php echo htmlspecialchars($user->username); ?>">
                            <?php echo htmlspecialchars($user->first_name . ' ' . $user->last_name); ?> (<?php echo htmlspecialchars($user->role); ?>)
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="" disabled>No users available</option>
                <?php endif; ?>
            </select>
        </div>
                    
                    <div class="form-group">
                        <label for="deadlineDate">Deadline Date:</label>
                        <input type="date" id="deadlineDate" name="deadlineDate" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="deadlineTime">Deadline Time:</label>
                        <input type="time" id="deadlineTime" name="deadlineTime" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="priority">Priority:</label>
                        <select id="priority" name="priority" required>
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                    
                    
                    <div class="form-actions">
                        <button type="submit">Assign Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
                </div>
    

</body>
</html>
