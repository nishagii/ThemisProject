<?php
class HomeJunior
{
    use Controller;

    public function index()
    {
        // Redirect if not logged in
        if (empty($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        $data['username'] = $_SESSION['username'] ?? 'User';
        $this->view('/juniorCounsel/home', $data);
    }
}

