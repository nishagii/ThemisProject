<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- this is imported to use icons -->
</head>

<body>
    <div class="body-container">
        <h4>Profile</h4>

        <div class="profile-section">
            <i class='bx bxs-user-circle profile-pic' id="profileIcon" onclick="toggleProfile()"></i>
            <div class="popup" id="popup">
                <div class="popup-content">
                    <i class="bx bxs-user-circle large-pic"></i>
                    <i class="bx bxs-pencil edit-pic-icon" title="Edit Profile Picture"></i>
                    <button class="close" id="close">Close</button>
                </div>
            </div>
            <div class="profile-info">
                <h2>Welcome, <?php echo $data['user']->email ?? 'User'; ?>!</h2>
                <p><?php echo isset($data['user']->role) ? ucfirst($data['user']->role) : 'Admin'; ?></p>
            </div>
            <button class="edit-button">
                <i class='bx bxs-pencil edit-icon'></i>
            </button>
        </div>
        
        <div class="personal-info-section">
            <div>
                <h3>Personal Info</h3>
                <div class="info-item">
                    <i class="bx bxs-user"></i>
                    <p>First Name: <?php echo  $_SESSION['username']?? 'Not set'; ?></p>

                    <p>First Name: <?php echo  $_SESSION['username']?? 'Not set'; ?></p>
                </div>
                <div class="info-item">
                    <i class="bx bxs-user"></i>
                    <p>Last Name: <?php echo $data['profile']->last_name ?? 'Not set'; ?></p>
                </div>
                <div class="info-item">
                    <i class="bx bxs-envelope"></i>
                    <p>Email: <?php echo $data['user']->email ?? 'Not set'; ?></p>
                </div>
                <div class="info-item">
                    <i class="bx bxs-phone"></i>
                    <p>Phone: <?php echo $data['profile']->phone ?? 'Not set'; ?></p>
                </div>
                <div class="info-item">
                    <i class="bx bxs-map"></i>
                    <p>Location: <?php echo $data['profile']->location ?? 'Not set'; ?></p>
                </div>
                <div class="password">
                    <button class="password-button">
                        <i class="bx bx-key"></i> Change Password
                    </button>
                </div>
            </div>
            <button class="edit-button" id="edit-personal-info">
                <i class="bx bxs-pencil edit-icon"></i>
            </button>
        </div>

        <div class="activity-section">
            <h3>Login Activity</h3>
            <div class="login-container">
                <table class="login-table">
                    <thead>
                        <tr>
                            <th>Last Login Date</th>
                            <th>Last Login Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>12/09/2024</td>
                            <td>10:00 A.M</td>
                        </tr>
                        <tr>
                            <td>12/09/2024</td>
                            <td>10:00 A.M</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#side-btn");
    let searchBtn = document.querySelector(".bx-search");
  
    // Only run if elements exist (prevents JS errors)
    if(closeBtn) {
        closeBtn.addEventListener("click", ()=>{
          sidebar.classList.toggle("open");
          menuBtnChange();//calling the function(optional)
        });
    }
  
    if(searchBtn) {
        searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
          sidebar.classList.toggle("open");
          menuBtnChange(); //calling the function(optional)
        });
    }
  
    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
     if(sidebar.classList.contains("open")){
       closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
     }else {
       closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
     }
    }

    function toggleProfile() {
        const popup = document.getElementById("popup");
        popup.style.display = popup.style.display === "block" ? "none" : "block";
    }

    // Close popup when close button is clicked
    document.getElementById("close").addEventListener("click", function() {
        document.getElementById("popup").style.display = "none";
    });
</script>

</html>*/