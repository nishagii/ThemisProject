<?php

class HomeClient
{
    use Controller;

    public function index()
    {

        if (empty($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        $data['username'] = $_SESSION['username'] ?? 'User';
        
        $this->view('/client/home', $data);
    }
}
