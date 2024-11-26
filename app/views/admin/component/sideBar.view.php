<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Admin Panel side bar</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/sideBar.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
   
    <!--side-bar-->

    <div class="side-container">

        <div class="sidebar">
   <div class="logo-details">
       <i class='bx bx-menu' id="side-btn" ></i>
   </div>
   <ul class="nav-list">
     <li>
       <a href="homeadmin">
           <i class='bx bx-user'></i>
           <span class="links_name">Add User</span>
       </a>
       <span class="tooltip">Add User</span>
   </li>
   <li>
       <a href="loginadmin">
           <i class='bx bx-history'></i>
           <span class="links_name">Login Activity</span>
       </a>
       <span class="tooltip">Login Activity</span>
   </li>    
    <li>
      <a href="systemhealth">
        <i class='bx bx-bar-chart-square'></i>
        <span class="links_name">System Health</span>
      </a>
      <span class="tooltip">System Health</span>
    </li>
    <li>
     <a href="security">
         <i class='bx bx-shield'></i>
         <span class="links_name">Security</span>
     </a>
     <span class="tooltip">Security</span>
   </li>
 
    <li class="profile">
        <div class="profile-details">
          <img src="<?= ROOT ?>/assets/images/themis_logo.png" alt="profileImg">
          <div class="name_job">
            <div class="name">VIP Solutions</div>
            <div class="job">Web desining</div>
          </div>
        </div>
        <i class='bx bx-log-out' id="log_out" ></i>
    </li>
   </ul>
 </div>
   <!--side-bar ends-->
   <script src="<?= ROOT ?>/assets/js/sideBar.js"> </script>
</body>
</html>