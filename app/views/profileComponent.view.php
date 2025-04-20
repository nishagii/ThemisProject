
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawyer Profile</title>
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
                <h2>Nadhiya Nashath</h2>
                <p>Admin</p>
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
                    <p>First Name: Nadhiya</p>
                </div>
                <div class="info-item">
                    <i class="bx bxs-user"></i>
                    <p>Last Name: Nashath</p>
                </div>
                <div class="info-item">
                    <i class="bx bxs-envelope"></i>
                    <p>Email: nashathnadhiya@gmail.com</p>
                </div>
                <div class="info-item">
                    <i class="bx bxs-phone"></i>
                    <p>Phone: 076-8811077</p>
                </div>
                <div class="info-item">
                    <i class="bx bxs-map"></i>
                    <p>Location: Sri Lanka</p>
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
            <div class="login-container" ></div>
                
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
  
    closeBtn.addEventListener("click", ()=>{
      sidebar.classList.toggle("open");
      menuBtnChange();//calling the function(optional)
    });
  
    searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
      sidebar.classList.toggle("open");
      menuBtnChange(); //calling the function(optional)
    });
  
    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
     if(sidebar.classList.contains("open")){
       closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
     }else {
       closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
     }
    }

    
    function toggleProfile() {
            const sortMenu = document.getElementById("popup");
            popup.style.display = popup.style.display === "block" ? "none" : "block";
            }



    </script>

</html>

</body>
</html>