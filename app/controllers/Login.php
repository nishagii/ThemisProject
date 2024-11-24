<?php

class Login
{
    use Controller;

    public function index()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $userModel = $this->loadModel('UserModel');

            // Attempt to login
            $user = $userModel->login($_POST);

            if ($user) {
                // Create session
                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;
                $_SESSION['role'] = $user->role;

                // Redirect based on role
                if ($user->role === 'admin') {
                    redirect('homeadmin');
                } elseif ($user->role === 'client') {
                    redirect('homeclient');
                } elseif ($user->role === 'lawyer') {
                    redirect('homelawyer');
                } elseif ($user->role === 'attorney') {
                    redirect('homeattorney');
                }elseif ($user->role === 'junior') {
                    redirect('homejunior');
                }else {
                    // Default role or error
                    redirect('generalDashboard');
                }

                exit();
            } else {
                $data['errors'] = ['Invalid username/email or password'];
            }
        }

        $this->view('/landingPage/login', $data);
    }
}
