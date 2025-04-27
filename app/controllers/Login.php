<?php
class Login {
    use Controller;
    
    public function index()
    {
        $data = [];
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $userModel = $this->loadModel('UserModel');
            $loginModel = $this->loadModel('LoginModel');  // Load the LoginModel to log the login attempt
            
            // Capture IP address
            $ipAddress = $_SERVER['REMOTE_ADDR'];  // Get the user's IP address
            
            // Check if the user exists first, regardless of password
            $userExists = $userModel->findUserByUsernameOrEmail($_POST['username'] ?? $_POST['email'] ?? '');
            
            // Attempt to login (checks both existence and correct password)
            $user = $userModel->login($_POST);
            
            if ($user) {
                // Create session
                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;
                $_SESSION['role'] = $user->role;
                $_SESSION['first_name'] = $user->first_name;
                $_SESSION['last_name'] = $user->last_name;
                $_SESSION['email'] = $user->email;
                $_SESSION['phone'] = $user->phone;
                
                // Log successful login attempt
                $loginData = [
                    'user_id'    => $user->id,
                    'ip_address' => $ipAddress,
                    'status'     => 'Success',  // Since the login was successful
                    'attempted_username' => $_POST['username'] ?? $_POST['email'] ?? '',
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
                // Handle failed login attempts
                if ($userExists) {
                    // User exists but password is wrong
                    $loginData = [
                        'user_id'    => $userExists->id, // We can use the actual user ID
                        'ip_address' => $ipAddress,
                        'status'     => 'Failure',
                        'attempted_username' => $_POST['username'] ?? $_POST['email'] ?? '',
                    ];
                } else {
                    // User doesn't exist at all
                    $loginData = [
                        'user_id'    => null, // No valid user ID for this case
                        'ip_address' => $ipAddress,
                        'status'     => 'Failure',
                        'attempted_username' => $_POST['username'] ?? $_POST['email'] ?? '',
                    ];
                }
                
                $loginModel->save($loginData);  // Save the failed login attempt
                $data['errors'] = ['Invalid username/email or password'];
            }
        }
        
        $this->view('/landingPage/login', $data);
    }
}