<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/landingPage/about.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php include('component/upBar.view.php'); ?>
    <?php include('component/navBar.view.php'); ?>

    <div class="content">
        <div class="welcome">
            <h2>Welcome to <br><span class="gold">THEMIS</span></h2>
            <p>
                At Themis, <br>we are dedicated to revolutionizing the way legal professionals manage their cases.<br>
                Our mission is to provide a comprehensive, user-friendly platform that simplifies case management,<br>
                enhances collaboration, and ensures data security.
            </p>
            <i class='bx bx-user-circle'></i>
        </div>
        <div class="welcome">
            <h2>Our <span class="gold">Story</span></h2>
            <p>
                Themis was born from the need for a streamlined legal case management system that addresses the
                unique challenges faced by legal teams. Our team of experienced legal professionals and tech experts
                came together to create a solution that combines legal expertise with cutting-edge technology.
            </p>
            <i class='bx bx-book'></i>
        </div>
        <div class="welcome">
            <h2>Our <span class="gold">Vision</span></h2>
            <p>
                We envision a world where legal professionals have access to the tools they need to work efficiently
                and effectively. Themis aims to bridge the gap between complex legal workflows and modern technology,
                enabling lawyers to focus on what they do best—serving their clients and advocating for justice.
            </p>
            <i class='bx bx-target-lock'></i>
        </div>
    </div>

    <?php include('component/footer.view.php'); ?>
    <script src="<?= ROOT ?>/assets/js/landingPage.js"></script>

</body>
</html>
