<?php

class Chat
{
    use Controller;

    public function index()
    {
        // Load the view
        $this->view('/seniorCounsel/chat');
    }
}
