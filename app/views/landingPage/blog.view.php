
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

    <?php include('component/footer.view.php'); ?>
    <script src="<?= ROOT ?>/assets/js/landingPage.js"></script>

</body>
</html>