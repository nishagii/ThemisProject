
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/bigNav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/landingPage/landingPage.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<?php include('component/upBar.view.php'); ?>
<?php include('component/navBar.view.php'); ?>


    <div class="writing-container">
        <span id="typed-text"></span>
        <div class="slogan">
            Discover your <span class="gold">LEGAL</span> needs! <br>
            <span class="gold">THEMIS</span> is here to aid you 
        </div>
    </div>

    <div class="themis">
        <div>
            <h2>Case management at your finger tips</h2>
            <p>
                Collaborate seamlessly with your legal team. 
                Leverage tools designed to manage cases with ease. 
                Experience streamlined workflows and a unified approach to case management that keeps everyone on the same page.
            </p>
        </div>
    </div>

    <div class="client">
        <p>
            <div class="contain">
                <span class="bold">Are you a THEMIS client ? </span>
                <br>Sign up to experience effortless legal management
                <br>
                <br>
                <div class="login-register">
                    <a href="../register.html" class="login-button register-button">SIGN UP</a>
            </div>
            
        </p>
        </div>
            <ul class="list">
                <li><span class="bold">Real-Time Updates: </span>Track your case progress instantly.</li>
                <li><span class="bold">Easy Communication: </span>Connect with your lawyer anytime.</li>
                <li><span class="bold">Secure Document Access: </span>Manage all your files in one place.</li>
                <li><span class="bold"> Appointment Scheduling: </span>SimpleBook and manage meetings with ease.</li>
                <li><span class="bold">Clear Billing: </span>Understand and track your expenses clearly.</li>
            </ul>
        </p>
    </div>
    <div class="empower">
        <div class="empower-text">
            <h2>Empower Your Legal Journey</h2>
            <p>At THEMIS, we believe that effective legal management should be accessible and user-friendly. Our platform is designed to simplify your experience, allowing you to focus on what truly matters - your case.</p>
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