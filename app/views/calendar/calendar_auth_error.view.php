<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS - Calendar Authentication Error</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/calendar.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

    <div class="error-container">
        <div class="error-card">
            <div class="error-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <h1>Calendar Authentication Error</h1>
            <p>We encountered a problem while trying to authenticate with your Google Calendar.</p>

            <div class="error-details">
                <p>This could be due to:</p>
                <ul>
                    <li>Expired or invalid authentication credentials</li>
                    <li>Denied permission to access your calendar</li>
                    <li>Connection issues with Google's servers</li>
                    <li>Missing or invalid OAuth configuration</li>
                </ul>
            </div>

            <div class="error-actions">
                <a href="<?= ROOT ?>/calendar" class="btn btn-retry">
                    <i class="fas fa-sync-alt"></i> Try Again
                </a>
                <a href="<?= ROOT ?>/seniorCounsel/home" class="btn btn-home">
                    <i class="fas fa-home"></i> Return to Dashboard
                </a>
            </div>

            <div class="error-help">
                <p>If this problem persists, please contact your system administrator for assistance.</p>
            </div>
        </div>
    </div>
</body>

</html>