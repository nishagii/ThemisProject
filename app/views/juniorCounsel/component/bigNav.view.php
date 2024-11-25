<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/bigNav.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->

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
                <li><a href="#">Home</a></li>
                <li><a href="caseJunior">Cases</a></li>
                <li><a href="salary">Salary</a></li>
                <li><a href="precedent">Precedents</a></li>
            </ul>
        </nav>

                    <div class="navbar-icons">
            <i data-modal-target="#popup" class="fas fa-envelope" id="envelope-icon"></i>
            <i class="fas fa-bell"></i>
            <a href="#" id="settings-icon">
                <i class="fas fa-cog"></i>
            </a>
            <div id="settings-menu" class="settings-menu hidden">
                <ul>
                    <li><a href="logout">Logout</a></li>
                </ul>
            </div>

            <a href="profile.php">
            <i class="fas fa-user-circle" id="profile-icon"></i>
            </a>
            </div>

            <!-- Popup element -->
            <div id="popup" class="popup">
            <p>This is your memo popup content.</p>
            </div>

    </div>
    <script src="<?= ROOT ?>/assets/js/memo.js"> </script>
</body>
</html>
