<?php

class Chat
{
    use Controller;

    public function index()
    {
        $userModel = $this->loadModel('UserModel');
        $users = $userModel->getAllUsers();
        // Load the view
        $this->view('/seniorCounsel/chat', ['users' => $users]);
    }

    // public function message_left($data) {

    // }
}
