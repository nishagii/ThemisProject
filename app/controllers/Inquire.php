<?php

// HomeAdmin class
class Inquire
{
    use Controller;

    public function index()
    {

        

        // Load the view with data
        $this->view('/landingPage/inquire');
    }
}
