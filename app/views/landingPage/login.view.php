<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/landingPage/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <title>
        Themis
    </title>
</head>

<body>
    <div class="container">
        <div class="white">

            <button class="button register">
                <i class="bx bx-user-plus icon"></i> <!-- Boxicon for registration -->
                <a href="<?= ROOT ?>/registeruser">Register</a>
            </button>

            <img src="<?= ROOT ?>/assets/images/themis_logo.png" class="white-logo">
            <div class="heading">
                <h1 class="welcome">Welcome Back!</h1>
                <h1 class="login">Login to your account</h1>
            </div>
            <form action="" method="POST">
                <input type="text" name="username" placeholder="Enter username or email" required> <br />
                <div class="pword">
                    <input type="password" name="password" id="password" placeholder="Enter password" required>
                    <i class="bx bxs-show view" id="view"></i> <!-- Boxicon for visibility toggle -->
                </div>

                <br />
                <div class="remember-me">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>
                <input type="submit" value="Log In" class="login"> <br />
            </form>
            <a href="">Forgot password ?</a> <br>
        </div>
        <div class="colour">
            <img src="<?= ROOT ?>/assets/images/themis_logo.png" class="colour-logo">
        </div>
    </div>
</body>

</html>