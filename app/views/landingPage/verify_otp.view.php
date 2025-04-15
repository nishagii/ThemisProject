<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/landingPage/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Verify OTP - Themis</title>
    <style>
        .otp-input {
            letter-spacing: 10px;
            font-size: 24px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="white">
            <div class="flex">
                <a href="<?= ROOT ?>/forgotpassword"><button class="home"><i class="fas fa-arrow-left"></i> </button></a>
            </div>
            <img src="<?= ROOT ?>/assets/images/themis_logo.png" class="white-logo">
            <div class="heading">
                <h1 class="welcome">Verify OTP</h1>
                <h1 class="login">Enter the OTP sent to your email</h1>
            </div>

            <?php if (!empty($data['errors'])): ?>
                <div class="error-messages">
                    <?php foreach ($data['errors'] as $error): ?>
                        <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= ROOT ?>/forgotpassword/verifyotp" method="POST">
                <input type="text" name="otp" class="otp-input" placeholder="Enter OTP" maxlength="6" required> <br />
                <input type="submit" value="Verify OTP" class="login"> <br />
            </form>
            <p>Didn't receive the OTP? <a href="<?= ROOT ?>/forgotpassword">Request again</a></p>
        </div>
        <div class="colour">
            <img src="<?= ROOT ?>/assets/images/themis_logo.png" class="colour-logo">
        </div>
    </div>
</body>

</html>