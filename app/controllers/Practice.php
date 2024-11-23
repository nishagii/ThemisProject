<?php

class Practice
{
    use Controller;

    public function index()
    {

        

        // Load the view with data
        $this->view('/landingPage/practice');
    }
}
