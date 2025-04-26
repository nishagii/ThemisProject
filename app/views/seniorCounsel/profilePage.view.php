<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawyer Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
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
                <?php
                // Get user details from session or database
                $firstName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';
                $lastName = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : '';
                $fullName = trim("$firstName $lastName");
                
                // If no name is available in session, you might need to fetch from database
                if (empty($fullName) && isset($_SESSION['user_id'])) {
                    // This is a placeholder for where you might fetch user data from the database
                    // $userModel = new UserModel();
                    // $user = $userModel->findById($_SESSION['user_id']);
                    // $fullName = $user->first_name . ' ' . $user->last_name;
                }
                
                // Fallback if still no name
                if (empty($fullName)) {
                    $fullName = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
                }
                ?>
                <h2><?= htmlspecialchars($fullName) ?></h2>
                <p><?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '' ?></p>
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
                    <p>First Name: <?= isset($_SESSION['first_name']) ? htmlspecialchars($_SESSION['first_name']) : 'Not set' ?></p>
                </div>
                <div class="info-item">
                    <i class="bx bxs-user"></i>
                    <p>Last Name: <?= isset($_SESSION['last_name']) ? htmlspecialchars($_SESSION['last_name']) : 'Not set' ?></p>
                </div>
                <div class="info-item">
                    <i class="bx bxs-envelope"></i>
                    <p>Email: <?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Not set' ?></p>
                </div>
                <div class="info-item">
                    <i class="bx bxs-phone"></i>
                    <p>Phone: <?= isset($_SESSION['phone']) ? htmlspecialchars($_SESSION['phone']) : 'Not set' ?></p>
                </div>
                <div class="info-item">
                    <i class="bx bxs-map"></i>
                    <p>Location: <?= isset($_SESSION['location']) ? htmlspecialchars($_SESSION['location']) : 'Not set' ?></p>
                </div>
                <div class="password">
                    <button class="password-button">
                        <i class="bx bx-key"></i> Change Password
                    </button>
                </div>
            </div>
            <button class="edit-button">
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
                        <?php
                        // This is where you would fetch login history from your database
                        // For example:
                        // $loginModel = new LoginModel();
                        // $loginHistory = $loginModel->getRecentLogins($_SESSION['user_id'], 5); // Get last 5 logins
                        // if ($loginHistory) {
                        //     foreach ($loginHistory as $login) {
                        //         echo '<tr>';
                        //         echo '<td>' . date('d/m/Y', strtotime($login->login_date)) . '</td>';
                        //         echo '<td>' . date('h:i A', strtotime($login->login_date)) . '</td>';
                        //         echo '</tr>';
                        //     }
                        // } else {
                        //     echo '<tr><td colspan="2">No login history available</td></tr>';
                        // }
                        ?>
                        <!-- Placeholder data until login history functionality is implemented -->
                        <tr>
                            <td>12/09/2024</td>
                            <td>10:00 A.M</td>
                        </tr>
                        <tr>
                            <td>12/09/2024</td>
                            <td>10:00 A.M</td>
                        </tr>
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
  
    closeBtn.addEventListener("click", ()=>{
      sidebar.classList.toggle("open");
      menuBtnChange();
    });
  
    searchBtn.addEventListener("click", ()=>{ 
      sidebar.classList.toggle("open");
      menuBtnChange(); 
    });
  
    function menuBtnChange() {
     if(sidebar.classList.contains("open")){
       closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
     }else {
       closeBtn.classList.replace("bx-menu-alt-right","bx-menu");
     }
    }
    
    function toggleProfile() {
        const popup = document.getElementById("popup");
        popup.style.display = popup.style.display === "block" ? "none" : "block";
    }
    
    // Close button functionality
    document.getElementById("close").addEventListener("click", function() {
        document.getElementById("popup").style.display = "none";
    });
</script>

</html>