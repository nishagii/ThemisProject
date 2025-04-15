<?php

// HomeAdmin class
class HomeAdmin
{
    use Controller;

    public function index()
    {
        if (empty($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        $data['username'] = $_SESSION['username'] ?? 'User';

        $userModel = $this->loadModel('UserModel');
        $loginModel = $this->loadModel('LoginModel');  // Load the LoginModel to get login details

        // Count total users
        $data['total_users'] = $userModel->countUsers();

        // Count total clients
        $data['total_clients'] = $userModel->countClients();

        // Retrieve login details for the logged-in user
        $userId = $_SESSION['user_id'];  // Get the logged-in user's ID
        $data['login_details'] = $loginModel->getLoginDetailsByUserId($userId);

        // Load the view with data
        $this->view('/admin/home', $data);
    }
}
