<?php

class Register
{
    use Controller;

    public function index()
    {

        

        // Load the view with data
        $this->view('/landingPage/register');
    }
}
