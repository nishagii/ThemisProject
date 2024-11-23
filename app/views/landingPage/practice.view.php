
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/landingPage/practice.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/bigNav.css">
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


    <?php include('component/footer.view.php'); ?>
    <script src="<?= ROOT ?>/assets/js/landingPage.js"></script>

</body>
</html>