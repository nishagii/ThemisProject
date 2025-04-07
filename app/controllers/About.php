<?php

class About
{
    use Controller;

    public function index()
    {

        

        // Load the view with data
        $this->view('/landingPage/about');
    }
}
