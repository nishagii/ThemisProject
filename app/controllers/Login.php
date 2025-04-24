<?php

class Login
{
    use Controller;

    public function index()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $userModel = $this->loadModel('UserModel');
            $loginModel = $this->loadModel('LoginModel');  // Load the LoginModel to log the login attempt


           

            // Attempt to login
            $user = $userModel->login($_POST);

            // Capture IP address
            $ipAddress = $_SERVER['REMOTE_ADDR'];  // Get the user's IP address

            if ($user) {
                // Create session
                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;
                $_SESSION['role'] = $user->role;
                $_SESSION['first_name'] = $user->first_name;
                $_SESSION['last_name'] = $user->last_name;
                $_SESSION['email'] = $user->email;
                $_SESSION['phone'] = $user->phone;
                $_SESSION['last_name'] = $user->last_name;


                // Log successful login attempt
                $loginData = [
                    'user_id'    => $user->id,
                    'ip_address' => $ipAddress,
                    'status'     => 'Success',  // Since the login was successful
                ];
                $loginModel->save($loginData);  // Save the login details into the database

                // Redirect based on role
                if ($user->role === 'admin') {
                    redirect('homeadmin?login=success');
                } elseif ($user->role === 'client') {
                    redirect('homeclient?login=success');
                } elseif ($user->role === 'lawyer') {
                    redirect('homelawyer?login=success');
                } elseif ($user->role === 'attorney') {
                    redirect('homejunior?login=success');
                } elseif ($user->role === 'junior') {
                    redirect('homejunior?login=success');
                } elseif ($user->role === 'precedent') {
                    redirect('precedentscontroller/index?login=success');
                } else {
                    // Default role or error
                    redirect('generalDashboard');
                }

                exit();
            } else {
                // Log failed login attempt
                $loginData = [
                    'user_id'    => null,  // No valid user ID for failed login
                    'ip_address' => $ipAddress,
                    'status'     => 'Failure',  // Login failed
                ];
                $loginModel->save($loginData);  // Save the failed login attempt into the database

                $data['errors'] = ['Invalid username/email or password'];
                // var_dump($data['errors']); // Debug here
            }
        }

        $this->view('/landingPage/login', $data);
    }
}
