<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawyer Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
        }

        .close-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-modal:hover,
        .close-modal:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .submit-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-button:hover {
            background-color: #45a049;
        }

        /* Alert messages */
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>
    <div class="body-container home-section">
        <h4>Profile<?php

echo "<script>console.log(" . json_encode($_SESSION) . ");</script>";
?>      </h4>

        <!-- Alert Messages -->
        <?php if (isset($_GET['update']) && $_GET['update'] === 'success'): ?>
            <div class="alert alert-success">Profile updated successfully!</div>
        <?php elseif (isset($_GET['update']) && $_GET['update'] === 'error'): ?>
            <div class="alert alert-danger">Failed to update profile.</div>
        <?php endif; ?>

        <?php if (isset($_GET['password']) && $_GET['password'] === 'success'): ?>
            <div class="alert alert-success">Password changed successfully!</div>
        <?php elseif (isset($_GET['password']) && $_GET['password'] === 'error'): ?>
            <div class="alert alert-danger">Failed to change password.</div>
        <?php endif; ?>

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
                
                // Fallback if still no name
                if (empty($fullName)) {
                    $fullName = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
                }
                ?>
                <h2><?= htmlspecialchars($fullName) ?></h2>
                <p><?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '' ?></p>
            </div>
            <button class="edit-button" id="editProfileBtn">
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
                    <button class="password-button" id="changePasswordBtn">
                        <i class="bx bx-key"></i> Change Password
                    </button>
                </div>
            </div>
            <button class="edit-button" id="editPersonalInfoBtn">
                <i class="bx bxs-pencil edit-icon"></i>
            </button>
        </div>

        <!-- In your profileComponent.php view file -->
<!-- At the location where you want to display the login history -->

        <div class="activity-section">
            <h3>Login Activity</h3>
            <div class="login-container">
                <table class="login-table">
                    <thead>
                        <tr>
                        <th>Login Time</th>
                            <th>IP Address</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($data['login_history']) && !empty($data['login_history'])): ?>
                            <?php foreach ($data['login_history'] as $login): ?>
                                <tr>
                                <td><?= htmlspecialchars($login->login_time) ?></td>
                                    <td><?= htmlspecialchars($login->ip_address) ?></td>
                                    <td><?= htmlspecialchars($login->status) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">No login history available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div id="editProfileModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h3>Edit Profile</h3>
            <form id="editProfileForm" action="<?= ROOT ?>/profile/updateProfile" method="POST">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="<?= isset($_SESSION['first_name']) ? htmlspecialchars($_SESSION['first_name']) : '' ?>">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="<?= isset($_SESSION['last_name']) ? htmlspecialchars($_SESSION['last_name']) : '' ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" value="<?= isset($_SESSION['phone']) ? htmlspecialchars($_SESSION['phone']) : '' ?>">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" value="<?= isset($_SESSION['location']) ? htmlspecialchars($_SESSION['location']) : '' ?>">
                </div>
                <button type="submit" class="submit-button">Update Profile</button>
            </form>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div id="changePasswordModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h3>Change Password</h3>
            <form id="changePasswordForm" action="<?= ROOT ?>/profile/changePassword" method="POST">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="submit-button">Change Password</button>
            </form>
        </div>
    </div>
</body>

<script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#side-btn");
    let searchBtn = document.querySelector(".bx-search");
  
    if (closeBtn) {
        closeBtn.addEventListener("click", ()=>{
          sidebar.classList.toggle("open");
          menuBtnChange();
        });
    }
  
    if (searchBtn) {
        searchBtn.addEventListener("click", ()=>{ 
          sidebar.classList.toggle("open");
          menuBtnChange(); 
        });
    }
  
    function menuBtnChange() {
        if(sidebar && sidebar.classList.contains("open")){
           closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        }else {
           closeBtn.classList.replace("bx-menu-alt-right","bx-menu");
        }
    }
    
    function toggleProfile() {
        const popup = document.getElementById("popup");
        popup.style.display = popup.style.display === "block" ? "none" : "block";
    }
    
    // Close button functionality for profile popup
    document.getElementById("close").addEventListener("click", function() {
        document.getElementById("popup").style.display = "none";
    });

    // Modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Get modal elements
        const editProfileModal = document.getElementById("editProfileModal");
        const changePasswordModal = document.getElementById("changePasswordModal");
        const editProfileBtn = document.getElementById("editProfileBtn");
        const editPersonalInfoBtn = document.getElementById("editPersonalInfoBtn");
        const changePasswordBtn = document.getElementById("changePasswordBtn");
        const closeButtons = document.querySelectorAll(".close-modal");
        
        // Edit profile button events
        if (editProfileBtn) {
            editProfileBtn.addEventListener("click", function() {
                editProfileModal.style.display = "block";
            });
        }
        
        if (editPersonalInfoBtn) {
            editPersonalInfoBtn.addEventListener("click", function() {
                editProfileModal.style.display = "block";
            });
        }
        
        // Password change button event
        if (changePasswordBtn) {
            changePasswordBtn.addEventListener("click", function() {
                changePasswordModal.style.display = "block";
            });
        }
        
        // Close button events
        closeButtons.forEach(button => {
            button.addEventListener("click", function() {
                editProfileModal.style.display = "none";
                changePasswordModal.style.display = "none";
            });
        });
        
        // Close modal when clicking outside
        window.addEventListener("click", function(event) {
            if (event.target == editProfileModal) {
                editProfileModal.style.display = "none";
            }
            if (event.target == changePasswordModal) {
                changePasswordModal.style.display = "none";
            }
        });
        
        // Form submissions with AJAX
        const editProfileForm = document.getElementById("editProfileForm");
        const changePasswordForm = document.getElementById("changePasswordForm");
        
        if (editProfileForm) {
            editProfileForm.addEventListener("submit", function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Show success message
                        alert(data.message);
                        // Reload the page to show updated info
                        location.reload();
                    } else {
                        // Show error message
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            });
        }
        
        if (changePasswordForm) {
            changePasswordForm.addEventListener("submit", function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Show success message
                        alert(data.message);
                        // Reset form and close modal
                        this.reset();
                        changePasswordModal.style.display = "none";
                    } else {
                        // Show error message
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            });
        }
        
        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        if (alerts.length > 0) {
            setTimeout(function() {
                alerts.forEach(alert => {
                    alert.style.display = 'none';
                });
            }, 5000);
        }
    });
</script>

</html>