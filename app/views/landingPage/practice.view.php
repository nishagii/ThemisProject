
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/landingPage/about.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<?php include('component/upBar.view.php'); ?>
<?php include('component/navBar.view.php'); ?>


<div class="content">
        <div class="welcome">
        <h2>Welcome to <br><span class="gold">THEMIS</span></h2>

        <p>At Themis, <br>we are dedicated to revolutionizing the way legal professionals manage their cases.<br> Our mission is to provide a comprehensive, user-friendly platform that simplifies case management,<br> enhances collaboration, and ensures data security.</p>
        <img src="<?= ROOT ?>/assets/images/about.png" height="200">
    </div>
    <div class="welcome">
        <h2>Our <span class="gold">Story</span></h2>

        <p>Themis was born from the need for a streamlined legal case management system that addresses the unique challenges faced by legal teams. Our team of experienced legal professionals and tech experts came together to create a solution that combines legal expertise with cutting-edge technology.</p>
        <img src="<?= ROOT ?>/assets/images/story.png" height="200">
    </div>
    <div class="welcome">
        <h2>Our <span class="gold">Vision</span></h2>

        <p>We envision a world where legal professionals have access to the tools they need to work efficiently and effectively. Themis aims to bridge the gap between complex legal workflows and modern technology, enabling lawyers to focus on what they do best—serving their clients and advocating for justice.</p>
        <img src="<?= ROOT ?>/assets/images/gavel.png" height="200">
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