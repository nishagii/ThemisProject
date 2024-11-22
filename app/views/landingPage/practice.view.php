
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/landingPage/practice.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<?php include('component/upBar.view.php'); ?>
<?php include('component/navBar.view.php'); ?>

<div class="practice-container">
        <header>
            <h1>Banking and Finance Law</h1>
            <p>At Themis, we are recognized as a premier law firm specializing in Banking and Finance law in Sri Lanka.</p>
        </header>

        <section class="expertise">
            <h2>Our Expertise</h2>
            <ul class="practice">
                <li><strong>Cross-Border Financing:</strong> Guidance on securing financing across international borders while ensuring compliance with local regulations.</li>
                <li><strong>Asset and Project Finance:</strong> Structuring and securing financing for major projects, offering insights into legal requirements and best practices.</li>
                <li><strong>Financial Instruments:</strong> Navigating the complexities of various financial products while ensuring compliance with applicable laws.</li>
                <li><strong>Sri Lanka Exchange Control Laws:</strong> Advising on exchange control regulations, enabling compliance with legal landscapes surrounding currency exchange.</li>
            </ul>
        </section>

        <section class="solutions">
            <h2>Tailored Solutions</h2>
            <p>We pride ourselves on delivering bespoke solutions for multinational corporations, financial institutions, and individual clients. Our approach ensures compliance while providing strategic advantages in this complex sector.</p>
        </section>
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