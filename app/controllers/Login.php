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
                    redirect('homejunior?login=success');
                }elseif ($user->role === 'junior') {
                    redirect('homejunior?login=success');
                }elseif ($user->role === 'precedent') {
                    redirect('precedentscontroller/index?login=success');
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

        $mode = "enter_email";
        if(isset($_GET['mode'])) {
            $mode = $_GET['mode'];
        }

        if(count($_POST) > 0) {
            switch ($mode) {
                case 'enter_email':
                    redirect("login?mode=enter_code");
                    die;
                    break;
                case 'enter_code':
                    redirect("login?mode=enter_password");
                    die;
                    break;
                case 'enter_password':
                    redirect("login");
                    die;
                    break;
                default:
                    break;
            }
        }

        $this->view('/landingPage/login', ['data' => $data, 'mode' => $mode]);

    }

}
