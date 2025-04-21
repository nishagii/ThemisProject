<?php

class UsersAdmin
{
    use Controller;

    public function index()
    {
        // Load the model
        $userModel = $this->loadModel('UserModel');

        // Get all users
        $users = $userModel->getAllUsers(); // You can use your custom method if different

        // Pass users to the view
        $this->view('/admin/system_users', [
            'users' => $users
        ]);
    }
}
