<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/landingPage/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <title>
        Themis
    </title>
    <style>
        /* Styling for success message */
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            padding: 10px;
            margin: 15px 0;
            text-align: center;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('register');

            if (status === 'success') {
                Swal.fire({
                    title: 'Registration Successful!',
                    text: 'Your account has been created successfully.',
                    icon: 'success',
                    confirmButtonText: 'Login to continue',
                });
            }
        });
    </script>
    <div class="container">
        <div class="white">

            <div class="flex">
                <!-- Boxicon for registration -->
                <a href="landingpage"><button class="home"><i class="fas fa-arrow-left"></i> </button></a>
                <a href="registeruser"><button class="button register">Register </button></a>

            </div>
            <img src="<?= ROOT ?>/assets/images/themis_logo.png" class="white-logo">
            <div class="heading">
                <h1 class="welcome">Welcome Back!</h1>
                <h1 class="login">Login to your account</h1>
            </div>
            <?php if (!empty($data['errors'])): ?>
                <div class="error-messages">
                    <?php foreach ($data['errors'] as $error): ?>
                        <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['reset']) && $_GET['reset'] === 'success'): ?>
                <div class="success-message">
                    <p>Your password has been reset successfully. You can now log in with your new password.</p>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <input type="text" name="username" placeholder="Enter username or email" required> <br />
                <div class="pword">
                    <input type="password" name="password" id="password" placeholder="Enter password" required>
                    <i class="bx bxs-show view" id="view"></i> <!-- Boxicon for visibility toggle -->
                </div>

                <br />
                <input type="submit" value="Log In" class="login"> <br />
            </form>
            <a href="<?= ROOT ?>/forgotpassword">Forgot password ?</a> <br>
        </div>
        <div class="colour">
            <img src="<?= ROOT ?>/assets/images/themis_logo.png" class="colour-logo">
        </div>
    </div>

    <!-- JavaScript for Password Toggle -->
    <script>
        const passwordInput = document.getElementById('password');
        const viewIcon = document.getElementById('view');

        viewIcon.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                viewIcon.classList.remove('bxs-show');
                viewIcon.classList.add('bxs-hide');
            } else {
                passwordInput.type = 'password';
                viewIcon.classList.remove('bxs-hide');
                viewIcon.classList.add('bxs-show');
            }
        });
    </script>
</body>

</html>