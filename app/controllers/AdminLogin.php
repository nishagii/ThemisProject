<?php

// HomeAdmin class
class AdminLogin
{
    use Controller;

    public function index()
    {
        if (empty($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
            redirect('login');
            return;
        }

        $data['username'] = $_SESSION['username'] ?? 'User';

        $userModel = $this->loadModel('UserModel');
        $loginModel = $this->loadModel('LoginModel');  

        // Retrieve login details for the logged-in user
        $userId = $_SESSION['user_id'];  // Get the logged-in user's ID
        $data['login_details'] = $loginModel->getLoginDetailsByUserId($userId);

        // Load the view with data
        $this->view('/admin/login', $data);
    }
}
