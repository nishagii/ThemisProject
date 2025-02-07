<?php

class Chat
{
    use Controller;

    public function index()
    {
        // Ensure session is started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $userModel = $this->loadModel('UserModel');
        $users = $userModel->getAllUsers();

        // Pass user session data
        $data['user'] = isset($_SESSION['user_id']) ? [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'] ?? 'User',
            'role' => $_SESSION['role'] ?? 'lawyer'
        ] : null;

        $data['users'] = $users;

        // Load the view and pass session & users data
        $this->view('/seniorCounsel/chat', $data);
    }

    
}
