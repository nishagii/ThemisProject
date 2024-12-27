<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/landingPage/inquire.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/bigNav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<?php include('component/upBar.view.php'); ?>
<?php include('component/navBar.view.php'); ?>

<div class="contact-form">
    <div class="white">
        <h2>Send Us a Message</h2>
        <form action="<?= ROOT ?>/Inquire" method="post">
            <!-- Name field -->
            <label for="name">Name</label><br>
            <input type="text" id="name" name="name" placeholder="Enter your name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
            <?php if (!empty($errors['name'])): ?>
                <p class="error"><?= $errors['name'] ?></p>
            <?php endif; ?>

            <!-- Email field -->
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" placeholder="Enter your email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            <?php if (!empty($errors['email'])): ?>
                <p class="error"><?= $errors['email'] ?></p>
            <?php endif; ?>

            <!-- Message field -->
            <label for="message">Message</label><br>
            <textarea id="message" name="message" rows="5" placeholder="Enter your message" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
            <?php if (!empty($errors['message'])): ?>
                <p class="error"><?= $errors['message'] ?></p>
            <?php endif; ?>

            <!-- Submit button -->
            <button type="submit">Send Message</button>
        </form>
    </div>
</div>

<div class="contact-container">
    <div class="contact-map">
        <a href="#" class="map-button">
            <img src="<?= ROOT ?>/assets/images/map.png" height="300" alt="Map Location">
        </a>
    </div>
    <div class="contact-details">
        <h3><i class="fas fa-map-marker-alt"></i> Address</h3>
        <p>No. 47, C.W.W. Kannangara Mawatha,<br>
        Alexandra Place,<br>
        Colombo 00700</p>
    </div>
</div>

<?php include('component/footer.view.php'); ?>

<script src="<?= ROOT ?>/assets/js/landingPage.js"></script>

</body>
</html>
