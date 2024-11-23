
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/bigNav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/landingPage/landingPage.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
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
        <h2>
            Case management at your fingertips
        </h2>
        <p>
            <i class="bx bx-group"></i> Collaborate seamlessly with your legal team. <br>
            <i class="bx bx-briefcase"></i> Leverage tools designed to manage cases with ease. <br>
            <i class="bx bx-chart"></i> Experience streamlined workflows and a unified approach 
            to case management that keeps everyone on the same page.
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
                <div>
                    <a href="../register.html" class="sign">SIGN UP</a>
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
            <h2> Empower Your Legal Journey</h2>
            <p><i class="bx bx-user-check"></i> At THEMIS, we believe that effective legal management should be accessible and user-friendly. Our platform is designed to simplify your experience, allowing you to focus on what truly matters - your case.</p>
        </div>
    </div>

    <div class="lp-container">
    <h2 class="heading">Comprehensive case management software that meets all your needs</h2>
    
    <div class="features">
      <div class="feature-card odd">
        <i class="bx bx-credit-card"></i>
        <h3>Billing & Payments</h3>
        <p>Make it easy to send bills and get paid</p>
      </div>
      <div class="feature-card even">
        <i class="bx bx-list-check"></i>
        <h3>Precedents tracking</h3>
        <p>Be up-to-date with all judgements</p>
      </div>
      <div class="feature-card odd">
        <i class="bx bx-folder"></i>
        <h3>Document Management</h3>
        <p>Every document, accessible from anywhere</p>
      </div>
      <div class="feature-card even">
        <i class="bx bx-calendar"></i>
        <h3>Calendaring</h3>
        <p>Reminders to hit every deadline</p>
      </div>
      <div class="feature-card odd">
        <i class="bx bx-book-content"></i>
        <h3>Court Rules</h3>
        <p>Be prepared for the law</p>
      </div>
      <div class="feature-card even">
        <i class="bx bx-user-pin"></i>
        <h3>User Friendly</h3>
        <p>A user friendly experience</p>
      </div>
    </div>
  </div>

    <?php include('component/footer.view.php'); ?>
    <script src="<?= ROOT ?>/assets/js/landingPage.js"></script>

</body>
</html>