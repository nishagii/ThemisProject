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
            <button class="forgot-btn" onclick="togglePopup()">Forgot password?</button>

            <div class="forgot-password-popup" id="forgot-password-popup">
                <div class="overlay"></div>
                <div class="content">
                    <a href="<?= ROOT ?>/login">
                        <div class="close-btn" onclick="togglePopup()">
                            &times;
                        </div>
                    </a>
                        <h2>Forgot your password?</h2>

                        <?php
                            switch ($mode) {
                                case 'enter_email': ?>

                                    <p>
                                    Enter your email below and we will send you an email with instructions to reset your password.
                                    </p>
                                    <form method="post" action="<?= ROOT ?>/login?mode=enter_email">
                                        <input type="text" placeholder="Enter your Email" name="email" required>
                                        <input type="submit" value="Send Reset Email">
                                    </form>
                                
                                <?php 
                                    break;
                                case 'enter_code':
                                    ?>

                                    <p>
                                    Please check your email for the code and enter it below.
                                    </p>
                                    <form method="post" action="<?= ROOT ?>/login?mode=enter_code">
                                        <input type="text" placeholder="Enter your code" name="code" required>
                                        <input type="submit" value="Enter">
                                    </form>
                                
                                <?php 
                                    break;
                                case 'enter_password':
                                    ?>

                                    <p>
                                    Enter your new password.
                                    </p>
                                    <form method="post" action="<?= ROOT ?>/login?mode=enter_password">
                                        <input type="password" placeholder="Enter your password" name="password" required>
                                        <input type="password" placeholder="Confirm your password" name="password2" required>
                                        <input type="submit" value="Submit">
                                    </form>
                                
                                <?php 
                                    break;
                                default:
                                    break;
                            }
                        ?>
                        
                </div>
            </div>
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

        document.addEventListener('DOMContentLoaded', () => {
    const forgotPasswordPopup = document.getElementById("forgot-password-popup");
    const currentMode = "<?= htmlspecialchars($mode ?? '', ENT_QUOTES, 'UTF-8') ?>";

    if (currentMode === 'enter_code' || currentMode === 'enter_password') {
        forgotPasswordPopup.classList.add("active");
    }
    
});

function togglePopup() {
    const forgotPasswordPopup = document.getElementById("forgot-password-popup");
    forgotPasswordPopup.classList.toggle("active");
}

    
    </script>
</body>

</html>