
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
            <form action="your-form-handler.php" method="post">
                <label for="name">Name</label><br>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>

                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="message">Message</label><br>
                <textarea id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
    <div class="contact-container">
        <div class="contact-map">

            <!-- google map API to show location -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9029768701894!2d79.85857797435165!3d6.902205493097074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25963120b1509%3A0x2db2c18a68712863!2sUniversity%20of%20Colombo%20School%20of%20Computing%20(UCSC)!5e0!3m2!1sen!2slk!4v1735126840010!5m2!1sen!2slk" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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