<!-- /views/admin/login.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Details</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
</head>
<body>
    <div class="login-container">


        <section class="login-history">
            <h2>Recent Login Activity</h2>
            
            <?php if (!empty($login_details)): ?>
                <div class="login-list">
                    <?php foreach ($login_details as $login): ?>
                        <div class="login-entry">
                            <div class="login-icon">
                                <i class="fas fa-key"></i>
                            </div>
                            <div class="login-info">
                                <div class="date"><?= date('F j, Y', strtotime($login->login_time)); ?></div>
                                <div class="time"><?= date('g:i a', strtotime($login->login_time)); ?></div>
                                <div class="ip">IP: <?= htmlspecialchars($login->ip_address); ?></div>
                                <div class="status">Status: <?= htmlspecialchars($login->status); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No login history available.</p>
            <?php endif; ?>
        </section>
    </div>

</body>
</html>
