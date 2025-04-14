<?php

// HomeAdmin class
class HomeAdmin
{
    use Controller;

    public function index()
    {
        // Set username from session, or default to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $userModel = $this->loadModel('UserModel');

        // Count total users
        $data['total_users'] = $userModel->countUsers();

        // Count total clients
        $data['total_clients'] = $userModel->countClients();

        // Load the view with data
        $this->view('/admin/home', $data);
    }
}
