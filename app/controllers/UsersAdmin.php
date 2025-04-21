<?php

class UsersAdmin
{
    use Controller;

    public function index()
    {
        $userModel = $this->loadModel('UserModel');

        $users = $userModel->getAllUsers(); 
        $this->view('/admin/system_users', [
            'users' => $users
        ]);
    }

    public function viewUser($id)
    {
        $userModel = $this->loadModel('UserModel');

        // Get the user by ID
        $user = $userModel->getUserById($id);

        if ($user) {
            // Load a view to show user details
            $this->view('/admin/view_user', [
                'user' => $user
            ]);
        } 
    }

}
