<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Admin Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/loginactivity.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- this is imported to use icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php include('component/navBar.view.php'); ?>
    <?php include('component/sideBar.view.php'); ?>

    <div class="home-section">
        <div class="login-container">
            <h2>Login Activity Of All Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>Logged In At</th>
                        <th>User Name</th>
                        <th>Status</th>
                        <th>User ID</th>
                        <th>IP Address</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($login)): ?>
                        <?php foreach($login as $log): ?>
                            <tr>
                                <td><?= date('M d, Y h:i:s A', strtotime($log->login_time)) ?></td>
                                <td><?= $log->username ?? 'Unknown' ?></td>
                                <td class="status <?= strtolower($log->status) === 'success' ? 'success' : 'failed' ?>"><?= strtoupper($log->status) ?></td>
                                <td><?= $log->user_id ?? 'N/A' ?></td>
                                <td><?= $log->ip_address ?? 'Unknown' ?></td>
                                <td><?= $log->role ?? 'Unknown' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">No login activity found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>