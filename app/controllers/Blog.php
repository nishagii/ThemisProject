<?php

class Blog
{
    use Controller;

    public function index()
    {

        

        // Load the view with data
        $this->view('/landingPage/blog');
    }
}
