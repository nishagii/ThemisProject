<?php

class Logout
{
    use Controller;

    public function index()
    {
        // Start the session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Destroy the session
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session

        // Redirect to login page
        redirect('login');
        exit();
    }
}
