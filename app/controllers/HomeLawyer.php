<?php

// HomeLawyer class
class HomeLawyer
{
    use Controller;

    public function index()
    {
        // Ensure session is started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Pass user session data
        $data['user'] = isset($_SESSION['user_id']) ? [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'] ?? 'User',
            'role' => $_SESSION['role'] ?? 'lawyer'
        ] : null;

        // Load the view with user data
        $this->view('/seniorCounsel/home', $data);
    }
}
