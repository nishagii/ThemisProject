<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/landingPage/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Reset Password - Themis</title>
</head>

<body>
    <div class="container">
        <div class="white">
            <img src="<?= ROOT ?>/assets/images/themis_logo.png" class="white-logo">
            <div class="heading">
                <h1 class="welcome">Reset Password</h1>
                <h1 class="login">Create a new password for your account</h1>
            </div>

            <?php if (!empty($data['errors'])): ?>
                <div class="error-messages">
                    <?php foreach ($data['errors'] as $error): ?>
                        <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= ROOT ?>/forgotpassword/resetpassword" method="POST">
                <div class="pword">
                    <input type="password" name="password" id="password" placeholder="Enter new password" required>
                    <i class="bx bxs-show view" id="view-password"></i>
                </div>
                <br />
                <div class="pword">
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm new password" required>
                    <i class="bx bxs-show view" id="view-confirm"></i>
                </div>
                <br />
                <input type="submit" value="Reset Password" class="login"> <br />
            </form>
        </div>
        <div class="colour">
            <img src="<?= ROOT ?>/assets/images/themis_logo.png" class="colour-logo">
        </div>
    </div>

    <!-- JavaScript for Password Toggle -->
    <script>
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('confirm_password');
        const viewPasswordIcon = document.getElementById('view-password');
        const viewConfirmIcon = document.getElementById('view-confirm');

        viewPasswordIcon.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                viewPasswordIcon.classList.remove('bxs-show');
                viewPasswordIcon.classList.add('bxs-hide');
            } else {
                passwordInput.type = 'password';
                viewPasswordIcon.classList.remove('bxs-hide');
                viewPasswordIcon.classList.add('bxs-show');
            }
        });

        viewConfirmIcon.addEventListener('click', () => {
            if (confirmInput.type === 'password') {
                confirmInput.type = 'text';
                viewConfirmIcon.classList.remove('bxs-show');
                viewConfirmIcon.classList.add('bxs-hide');
            } else {
                confirmInput.type = 'password';
                viewConfirmIcon.classList.remove('bxs-hide');
                viewConfirmIcon.classList.add('bxs-show');
            }
        });
    </script>
</body>

</html>