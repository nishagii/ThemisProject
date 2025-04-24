<?php

class Profile
{
    use Controller;
    
    public function index()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
        }
        
        $profileModel = $this->loadModel('ProfileModel');
        
        // Get user profile data
        $userId = $_SESSION['user_id'];
        $user = $profileModel->getUserProfile($userId);
        
        // Get login history directly from ProfileModel
        $loginHistory = $profileModel->getLoginDetailsByUserId($userId);
        
        // If user data exists, store in session for view access
        if ($user) {
            $_SESSION['first_name'] = $user->first_name;
            $_SESSION['last_name'] = $user->last_name;
            $_SESSION['email'] = $user->email;
            $_SESSION['phone'] = $user->phone;
            $_SESSION['location'] = isset($user->location) ? $user->location : '';
        }
        
        $data = [
            'user' => $user,
            'loginHistory' => $loginHistory
        ];
        
        $this->view('profile', $data);
    }
    
    public function updateProfile()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
        }
        
        $data = [];
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $profileModel = $this->loadModel('ProfileModel');
            
            $userId = $_SESSION['user_id'];
            
            // Collect form data
            $profileData = [
                'first_name' => $_POST['first_name'] ?? '',
                'last_name' => $_POST['last_name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'location' => $_POST['location'] ?? ''
            ];
            
            // Update profile
            if ($profileModel->updateProfile($userId, $profileData)) {
                // Update session variables
                $_SESSION['first_name'] = $profileData['first_name'];
                $_SESSION['last_name'] = $profileData['last_name'];
                $_SESSION['email'] = $profileData['email'];
                $_SESSION['phone'] = $profileData['phone'];
                $_SESSION['location'] = $profileData['location'];
                
                // Set success message
                $data['message'] = 'Profile updated successfully!';
                $data['status'] = 'success';
            } else {
                $data['message'] = 'Failed to update profile.';
                $data['status'] = 'error';
            }
            
            // Return JSON for AJAX request or redirect
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
                echo json_encode($data);
                exit;
            }
            
            redirect('profile?update=' . $data['status']);
        }
        
        redirect('profile');
    }
    
    public function changePassword()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
        }
        
        $data = [];
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $profileModel = $this->loadModel('ProfileModel');
            
            $userId = $_SESSION['user_id'];
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            // Get user for password verification
            $user = $profileModel->getUserProfile($userId);
            
            // Validate input
            if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                $data['message'] = 'All password fields are required.';
                $data['status'] = 'error';
            } elseif ($newPassword !== $confirmPassword) {
                $data['message'] = 'New passwords do not match.';
                $data['status'] = 'error';
            } elseif (!password_verify($currentPassword, $user->password)) {
                $data['message'] = 'Current password is incorrect.';
                $data['status'] = 'error';
            } elseif (strlen($newPassword) < 6) {
                $data['message'] = 'Password must be at least 6 characters.';
                $data['status'] = 'error';
            } else {
                // Update password
                if ($profileModel->updatePassword($userId, $newPassword)) {
                    $data['message'] = 'Password changed successfully!';
                    $data['status'] = 'success';
                } else {
                    $data['message'] = 'Failed to change password.';
                    $data['status'] = 'error';
                }
            }
            
            // Return JSON for AJAX request or redirect
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
                echo json_encode($data);
                exit;
            }
            
            redirect('profile?password=' . $data['status']);
        }
        
        redirect('profile');
    }
}