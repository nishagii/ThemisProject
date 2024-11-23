
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


    <?php include('component/footer.view.php'); ?>
    <script src="<?= ROOT ?>/assets/js/landingPage.js"></script>

</body>
</html>