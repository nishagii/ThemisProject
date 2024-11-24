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
                    redirect('homeadmin?login=success');
                } elseif ($user->role === 'client') {
                    redirect('homeclient?login=success');
                } elseif ($user->role === 'lawyer') {
                    redirect('homelawyer?login=success');
                } elseif ($user->role === 'attorney') {
                    redirect('homeattorney?login=success');
                }elseif ($user->role === 'junior') {
                    redirect('homejunior?login=success');
                }else {
                    // Default role or error
                    redirect('generalDashboard');
                }

                exit();
            } else {
                $data['errors'] = ['Invalid username/email or password'];
                // var_dump($data['errors']); // Debug here
            }
        }

        $this->view('/landingPage/login', $data);
    }
}
