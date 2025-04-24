<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Access Revoked - THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/no_calendar_access.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="icon-container">
                <i class="fas fa-calendar-times"></i>
            </div>
            <h1>Calendar Access Revoked</h1>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert success">
                    <i class="fas fa-check-circle"></i>
                    <?= $_SESSION['success'] ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= $_SESSION['error'] ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['info'])): ?>
                <div class="alert info">
                    <i class="fas fa-info-circle"></i>
                    <?= $_SESSION['info'] ?>
                    <?php unset($_SESSION['info']); ?>
                </div>
            <?php endif; ?>

            <p>You have successfully revoked access to your Google Calendar. Your calendar data is no longer accessible through THEMIS.</p>

            <div class="actions">
                <a href="<?= isset($authUrl) ? $authUrl : '#' ?>" class="btn primary">
                    <i class="fas fa-calendar-plus"></i> Reconnect to Google Calendar
                </a>

                <?php
                // Determine the dashboard URL based on user role
                $dashboardUrl = ROOT . '/home'; // Default dashboard

                if (isset($_SESSION['role'])) {
                    $userRole = $_SESSION['role'] ?? '';

                    switch ($userRole) {
                        case 'client':
                            $dashboardUrl = ROOT . '/homeclient';
                            break;
                        case 'attorney':
                            $dashboardUrl = ROOT . '/homeattorney';
                            break;
                        case 'junior':
                            $dashboardUrl = ROOT . '/homejunior';
                            break;
                        case 'lawyer':
                            $dashboardUrl = ROOT . '/homelawyer';
                            break;
                            // Add other roles as needed
                    }
                }
                ?>

                <a href="<?= $dashboardUrl ?>" class="btn secondary">
                    <i class="fas fa-home"></i> Return to Dashboard
                </a>


            </div>
        </div>
    </div>
</body>

</html>