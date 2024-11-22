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
                <li><a href="landingpage">Home</a></li>
                <li><a href="about">About</a></li>
                <li><a href="practice">Practice area</a></li>
                <li><a href="blog">blogs</a></li>
                <li ><a href="login">
                        <button class="login-button">LOG IN</button>
                    </a>
                </li>
                <li ><a href="register">
                        <button class="login-button">REGISTER</button>
                    </a>
                </li>
            </ul>
        </nav>



    </div>

</body>
</html>
