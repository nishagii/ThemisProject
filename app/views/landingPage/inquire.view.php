
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/landingPage/inquire.css">
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


    <div class="footer">
        <div class="footer-content">
            <div class="quick-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="lp.html">Home</a></li>
                    <li><a href="aboutus.html">About Us</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="practice area.html">Practice Area</a></li>
                    <li><a href="blog.html">Blog</a></li>
                </ul>
            </div>
            <div class="stay-connected">
                <img src="<?= ROOT ?>/assets/images/themis_logo.png" height="75">
                <h4>Stay Connected with Your Lawyer</h4>
                <p>
                    At THEMIS, we believe that effective legal management should be accessible and user-friendly. Our platform is designed to simplify your experience, allowing you to focus on what truly matters - your case.
                </p>
            </div>
            
            
            <div class="contact-info">
                <h4>Contact Our THEMIS Lawyer</h4>
                <p>076-1234567<br>
                johnkepling@gmail.com<br>
                63, Galle Road, Colombo-04</p>
            </div>
        </div>
        <div class="social-media">
            <h4>Follow Us</h4>
            <div class="social-icons">
                <a href="www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                <a href="www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Developed by VIP Software Solutions</p>
        </div>
    </div>
    <script src="<?= ROOT ?>/assets/js/landingPage.js"></script>

</body>
</html>