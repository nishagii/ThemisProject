<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/bigNav.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- this is imported to use icons -->
</head>

<body>
    <div class="container">
        <nav>
            <input type="checkbox" id="check"> <!-- check box to check and uncheck the menu in 768px screen -->
            <label for="check">
                <i class="fas fa-bars" id="btn"></i><!-- dropmenu 3 bars -->
                <i class="fas fa-times" id="cancel"></i>
            </label>
            <img src="<?= ROOT ?>/assets/images/themis_logo.png" alt="Logo" class="navbar-logo" />
            <ul class="big-navbar">
                <li><a href="<?= ROOT ?>/homeclient">Home</a></li>
                <li><a href="<?= ROOT ?>/PaymentController">Payments</a></li>

                <li><a href="<?= ROOT ?>/PrecedentClient/index">Precedents</a></li>

            </ul>
        </nav>

        <div class="navbar-icons">
            <i data-modal-target="#popup" class="fas fa-envelope" id="envelope-icon"></i>

            <div class="notification-container">
                <i class="fas fa-bell" id="notification-icon"></i>
                <span class="notification-badge" id="notification-count">0</span>
                <div id="notification-dropdown" class="notification-dropdown hidden">
                    <div class="notification-header">
                        <h3>Notifications</h3>
                    </div>
                    <div class="notification-list" id="notification-list">
                        <!-- Notifications will be populated by JavaScript -->
                    </div>
                    <div class="notification-footer">
                        <a href="#">View All</a>
                    </div>
                </div>
            </div>

            <a href="#" id="settings-icon">
                <i class="fas fa-cog"></i>
            </a>
            <div id="settings-menu" class="settings-menu hidden">
                <ul>
                    <li><a href="<?= ROOT ?>/logout">Logout</a></li>
                </ul>
            </div>
            <a href="clientprofile">
                <i class="fas fa-user-circle" id="profile-icon"></i>
            </a>
        </div>

        <!-- Popup element -->
        <div id="popup" class="popup">
            <p>This is your memo popup content.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Settings menu toggle
            const settingsIcon = document.getElementById('settings-icon');
            const settingsMenu = document.getElementById('settings-menu');

            settingsIcon.addEventListener('click', function(e) {
                e.preventDefault();
                settingsMenu.classList.toggle('hidden');
            });

            // Close settings menu when clicking elsewhere
            document.addEventListener('click', function(e) {
                if (!settingsIcon.contains(e.target) && !settingsMenu.contains(e.target)) {
                    settingsMenu.classList.add('hidden');
                }
            });


        });

        const ROOT = '<?= ROOT ?>';
    </script>
    <script src="<?= ROOT ?>/assets/js/memo.js"></script>
    <script src="<?= ROOT ?>/assets/js/notifications.js"></script>
</body>

</html>