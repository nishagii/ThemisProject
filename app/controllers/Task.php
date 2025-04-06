<?php

class Task
{
    use Controller;

    public function index()
    {
        if (empty($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        $data['username'] = $_SESSION['username'] ?? 'User';

        // Load the view
        $this->view('/juniorCounsel/task', $data);
    }
}
