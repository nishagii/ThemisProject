<?php
class ProfileJunior
{
    use Controller;
    
    public function index()
    {
        // Check if user is logged in
        if(empty($_SESSION['USER'])) {
            redirect('login'); // Redirect to login if not logged in
            return;
        }
        
        // Get user ID from session
        $user_id = $_SESSION['USER']->id;
        
        // Load user profile data
        $profile = new UserProfileModel();
        $profile_data = $profile->getByUserId($user_id);
        
        // Get login activity
        $login_model = new LoginLogModel();
        $login_logs = $login_model->getRecentByUserId($user_id, 5); // Get 5 recent logins
        
        // If profile exists, use that data, otherwise use basic user info
        if($profile_data) {
            $data['profile'] = $profile_data;
            $data['user'] = $_SESSION['USER'];
            $data['login_logs'] = $login_logs;
        } else {
            // If no profile data exists yet
            $data['user'] = $_SESSION['USER'];
            $data['profile'] = (object)[
                'first_name' => '',
                'last_name' => '',
                'phone' => '',
                'location' => '',
                'profile_picture' => '',
                'role' => 'Junior Counsel'
            ];
            $data['login_logs'] = $login_logs;
        }
        
        // Load the view with data
        $this->view('/juniorCounsel/profile', $data);
    }
    
    public function update()
    {
        // Handle profile updates here
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id = $_SESSION['USER']->id;
            $profile = new UserProfileModel();
            
            $data = [
                'user_id' => $user_id,
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'phone' => $_POST['phone'],
                'location' => $_POST['location']
            ];
            
            if($profile->saveOrUpdate($data)) {
                // Add success message to session
                $_SESSION['SUCCESS'] = "Profile updated successfully";
            } else {
                // Add error message to session
                $_SESSION['ERROR'] = "Failed to update profile";
            }
            
            // Redirect back to profile page
            redirect('profileJunior');
        }
    }
    
    public function uploadProfilePicture()
    {
        // Handle profile picture upload
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id = $_SESSION['USER']->id;
            $profile = new UserProfileModel();
            
            // Check if file was uploaded without errors
            if(isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                $filename = $_FILES['profile_picture']['name'];
                $filetype = $_FILES['profile_picture']['type'];
                $filesize = $_FILES['profile_picture']['size'];
                
                // Validate file extension
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if(!in_array(strtolower($ext), $allowed)) {
                    $_SESSION['ERROR'] = "Error: Please select a valid file format (JPG, JPEG, PNG, GIF).";
                    redirect('profileJunior');
                    return;
                }
                
                // Validate file size - 5MB maximum
                $maxsize = 5 * 1024 * 1024;
                if($filesize > $maxsize) {
                    $_SESSION['ERROR'] = "Error: File size is larger than the allowed limit (5MB).";
                    redirect('profileJunior');
                    return;
                }
                
                // Generate unique filename
                $new_filename = uniqid() . '.' . $ext;
                $upload_path = ROOT . '/public/uploads/profile_pictures/';
                
                // Create directory if it doesn't exist
                if(!file_exists($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }
                
                // Move the uploaded file
                if(move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload_path . $new_filename)) {
                    // Update database with new profile picture path
                    $db_path = '/uploads/profile_pictures/' . $new_filename;
                    if($profile->updateProfilePicture($user_id, $db_path)) {
                        $_SESSION['SUCCESS'] = "Profile picture updated successfully";
                    } else {
                        $_SESSION['ERROR'] = "Failed to update profile picture in database";
                    }
                } else {
                    $_SESSION['ERROR'] = "Failed to upload profile picture";
                }
            } else {
                $_SESSION['ERROR'] = "Error: " . $_FILES['profile_picture']['error'];
            }
            
            redirect('profileJunior');
        }
    }
    
    public function changePassword()
    {
        // Handle password change
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id = $_SESSION['USER']->id;
            $user = new UserModel();
            
            // Validate inputs
            if(empty($_POST['current_password']) || empty($_POST['new_password']) || empty($_POST['confirm_password'])) {
                $_SESSION['ERROR'] = "All password fields are required";
                redirect('profileJunior');
                return;
            }
            
            // Check if current password is correct
            if(!$user->verifyPassword($user_id, $_POST['current_password'])) {
                $_SESSION['ERROR'] = "Current password is incorrect";
                redirect('profileJunior');
                return;
            }
            
            // Check if new passwords match
            if($_POST['new_password'] !== $_POST['confirm_password']) {
                $_SESSION['ERROR'] = "New passwords do not match";
                redirect('profileJunior');
                return;
            }
            
            // Update password
            if($user->updatePassword($user_id, $_POST['new_password'])) {
                $_SESSION['SUCCESS'] = "Password changed successfully";
            } else {
                $_SESSION['ERROR'] = "Failed to change password";
            }
            
            redirect('profileJunior');
        }
    }
}