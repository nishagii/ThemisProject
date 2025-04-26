<?php

// HomeAdmin class
class HomeAttorney
{
    use Controller;

    public function __construct()
    {
        $this->requireLogin();
        $this->requireRole(['attorney' ,'junior']);
    }

    public function index()
    {

        // Set username from session, or default to 'User'
        $data['username'] = empty($_SESSION['username']) ? 'User' : $_SESSION['USER']->email;

        // Load the view with data
        $this->view('/attorney/home', $data);
    }
}
