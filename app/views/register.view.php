<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/register.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Themis</title>
</head>

<body>
    <div class="container">
        <div class="white">
            <img src="<?= ROOT ?>/assets/images/themis_logo.png" class="white-logo">
            <div class="flex">
                <!-- Boxicon for registration -->
                <a href="landingpage"><button class="home"><i class="fas fa-arrow-left"></i> </button></a>
                <a href="login"><button class="button register">Login </button></a>
           
            </div>
            <div class="heading">
            
                <h1 class="register">Are you a THEMIS client?<br>Create your account here</h1>
            </div>
            <div class="form">
                <form action="<?= ROOT ?>/registeruser" method="POST" novalidate>
                    <!-- First Name -->
                    <input type="text" class="first-name" name="firstname" placeholder="Enter first name" required value="<?= htmlspecialchars($_POST['firstname'] ?? '') ?>">
                    <p class="fname-error"><?= $errors['firstname'] ?? '' ?></p>

                    <!-- Last Name -->
                    <input type="text" class="last-name" name="lastname" placeholder="Enter last name" required value="<?= htmlspecialchars($_POST['lastname'] ?? '') ?>">
                    <p class="lname-error"><?= $errors['lastname'] ?? '' ?></p>

                    <!-- Username -->
                    <input type="text" name="username" placeholder="Enter username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                    <p class="uname-error"><?= $errors['username'] ?? '' ?></p>

                    <!-- Email -->
                    <input type="email" name="email" placeholder="Enter email address" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    <p class="email-error"><?= $errors['email'] ?? '' ?></p>

                    <!-- Phone Number -->
                    <input type="tel" name="tel" placeholder="Enter phone number" required value="<?= htmlspecialchars($_POST['tel'] ?? '') ?>">
                    <p class="tel-error"><?= $errors['tel'] ?? '' ?></p>

                    <!-- Password -->
                    <input type="password" name="password" placeholder="Enter password" required>
                    <p class="password-error"><?= $errors['password'] ?? '' ?></p>

                    <!-- Confirm Password -->
                    <input type="password" name="confirm_password" placeholder="Confirm password" required>
                    <p class="conf_password-error"><?= $errors['confirm_password'] ?? '' ?></p>

                    <!-- Terms and Conditions -->
                    <label>
                        <input type="checkbox" name="terms" required> I agree to the terms and conditions
                    </label>
                    <p class="terms-error"><?= $errors['terms'] ?? '' ?></p>

                    <!-- Submit -->
                    <input type="submit" value="Create account" class="register"> <br />
                </form>

                <!-- Backend Error -->
                <p class="backend-error"><?= $errors['general'] ?? '' ?></p>
            </div>
        </div>
        <div class="colour">
            <img src="<?= ROOT ?>/assets/images/themis_logo.png" class="colour-logo">
        </div>
    </div>
</body>

</html>