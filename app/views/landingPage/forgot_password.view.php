<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/landingPage/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Forgot Password - Themis</title>
    <style>
        /* Custom styles for email input field */
        input[type="email"] {
            width: 100%;
            padding: 12px 15px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        input[type="email"]:focus {
            border-color: #4a69bd;
            outline: none;
            box-shadow: 0 0 5px rgba(74, 105, 189, 0.3);
        }

        /* Error message styling */
        .error-messages {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
            border-radius: 5px;
            padding: 10px;
            margin: 15px 0;
            text-align: center;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="white">
            <div class="flex">
                <a href="<?= ROOT ?>/login"><button class="home"><i class="fas fa-arrow-left"></i> </button></a>
            </div>
            <img src="<?= ROOT ?>/assets/images/themis_logo.png" class="white-logo">
            <div class="heading">
                <h1 class="welcome">Forgot Password</h1>
                <h1 class="login">Enter your email to reset password</h1>
            </div>

            <?php if (!empty($data['errors'])): ?>
                <div class="error-messages">
                    <?php foreach ($data['errors'] as $error): ?>
                        <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= ROOT ?>/forgotpassword/requestreset" method="POST">
                <input type="email" name="email" placeholder="Enter your email address" required> <br />
                <input type="submit" value="Send Reset OTP" class="login"> <br />
            </form>
            <a href="<?= ROOT ?>/login">Back to Login</a> <br>
        </div>
        <div class="colour">
            <img src="<?= ROOT ?>/assets/images/themis_logo.png" class="colour-logo">
        </div>
    </div>
</body>

</html>