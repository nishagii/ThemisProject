<!DOCTYPE html>

<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/landingPage/register.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
        <title>
            Themis
        </title>
    </head>
    <body>
        <div class="container">
            <div class="white">
                <img src="<?= ROOT ?>/assets/images/themis_logo.png" class="white-logo">
                <div class="heading">
                    <h1 class="register">Create your account</h1>
                </div>
                <div class="form">
                    <form action="" method="">
                        <input type="text" class="first-name" name="firstname" placeholder="Enter first name" required> 
                        <input type="text" class="last-name" name="lastname" placeholder="Enter last name" required><br/>
                        <input type="text" name="username" placeholder="Enter user name" required><br/>
                        <input type="email" name="email" placeholder="Enter email address" required><br/>
                        <input type="tel" name="tel" placeholder="Enter phone number" required><br/>
                        <input type="password" name="password" placeholder="Enter password" required><br/>
                        <input type="password" name="confirm_password" placeholder="Confirm password" required><br/>
                        <input type="submit" value="Create account" class="register"> <br/>
                    </form>
                </div>
            </div>
            <div class="colour">
                <img src="<?= ROOT ?>/assets/images/themis_logo.png" class="colour-logo">
            </div>
        </div>
    </body>
</html>