
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/landingPage/blog.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<?php include('component/upBar.view.php'); ?>
<?php include('component/navBar.view.php'); ?>

<main class="main-content">
        <div class="blog-posts">
            <article class="post">
                <div class="post-content">
                    <h2 class="post-title">Minimum Wages Increased</h2>
                    <p class="post-meta">Posted on November 1, 2024 by Nadhiya Nashath</p>
                    <p class="post-content">The payment of a minimum monthly wage or daily wage to all workers in any private sector industry or service in Sri Lanka was made mandatory and given statutory effect by the passing of the National Minimum Wage of Workers Act No. 03 of 2016.</p>
                    <a href="#" class="read-more">Read More</a>
                </div>
                <img src="<?= ROOT ?>/assets/images/image1.jpg" alt="Blog Post 1 Image" class="post-image">
            </article>
            <article class="post">
                <div class="post-content">
                    <h2 class="post-title">Powers of Attorney</h2>
                    <p class="post-meta">Posted on November 1, 2024 by Nishagi</p>
                    <p class="post-content">The payment of a minimum monthly wage or daily wage to all workers in any private sector industry or service in Sri Lanka was made mandatory and given statutory effect by the passing of the National Minimum Wage of Workers Act No. 03 of 2016.</p>
                    <a href="#" class="read-more">Read More</a>
                </div>
                <img src="<?= ROOT ?>/assets/images/scale.jpeg" alt="Blog Post 1 Image" class="post-image">
            </article>
        </div>
    </main>

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