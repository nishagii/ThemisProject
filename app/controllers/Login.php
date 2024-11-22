<?php

class Login
{
    use Controller;

    public function index()
    {

        

        // Load the view with data
        $this->view('/landingPage/login');
    }
}
