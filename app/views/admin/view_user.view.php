<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details - THEMIS Admin Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php include('component/navBar.view.php'); ?>
    <?php include('component/sideBar.view.php'); ?>

    <div class="home-section">
        <div class="user-section">
            <h1>User Details</h1>

            <div class="user-detail-card">
                <div class="user-avatar-lg">
                    <span><?= strtoupper(substr($user->username, 0, 1)) ?></span>
                </div>

                <div class="user-detail-info">
                    <p><strong>ID:</strong> <span><?= htmlspecialchars($user->id) ?></span></p>
                    <p><strong>Name:</strong> <span><?= htmlspecialchars($user->username) ?></span></p>
                    <p><strong>Email:</strong> <span><?= htmlspecialchars($user->email) ?></span></p>
                    <p><strong>Role:</strong> <span><?= htmlspecialchars($user->role) ?></span></p>
                    <p>
                        <strong>Status:</strong>
                        <span class="view-badge <?= ($user->active ?? true) ? 'view-active' : 'view-inactive' ?>">
                            <?= ($user->active ?? true) ? 'Active' : 'Inactive' ?>
                        </span>
                    </p>
                    
                </div>

                <a href="<?= ROOT ?>/UsersAdmin" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back to Users
                </a>

                <p>
                    <strong>Actions:</strong>
                    <?php if (($user->active ?? true)): ?>
                        <button class="block-btn" onclick="blockUser(<?= $user->id ?>)">
                            <i class="fas fa-user-slash"></i> Block User
                        </button>
                    <?php else: ?>
                        <button class="unblock-btn" onclick="unblockUser(<?= $user->id ?>)">
                            <i class="fas fa-user-check"></i> Unblock User
                        </button>
                    <?php endif; ?>
                </p>

            </div>
        </div>
    </div>
</body>
</html>
