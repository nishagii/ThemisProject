<?php
class Login {
    use Controller;
    
    public function index()
    {
        $data = [];
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $userModel = $this->loadModel('UserModel');
            $loginModel = $this->loadModel('LoginModel');  
            
           
            $ipAddress = $_SERVER['REMOTE_ADDR'];  
            
           
            $userExists = $userModel->findUserByUsernameOrEmail($_POST['username'] ?? $_POST['email'] ?? '');
            
           
            $user = $userModel->login($_POST);
            
            if ($user) {
              
                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;
                $_SESSION['role'] = $user->role;
                $_SESSION['first_name'] = $user->first_name;
                $_SESSION['last_name'] = $user->last_name;
                $_SESSION['email'] = $user->email;
                $_SESSION['phone'] = $user->phone;
                
                
                $loginData = [
                    'user_id'    => $user->id,
                    'ip_address' => $ipAddress,
                    'status'     => 'Success',  
                    'attempted_username' => $_POST['username'] ?? $_POST['email'] ?? '',
                ];
                $loginModel->save($loginData);  
                
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
                   
                    redirect('generalDashboard');
                }
                
                exit();
            } else {
               
                if ($userExists) {
                   
                    $loginData = [
                        'user_id'    => $userExists->id, 
                        'ip_address' => $ipAddress,
                        'status'     => 'Failure',
                        'attempted_username' => $_POST['username'] ?? $_POST['email'] ?? '',
                    ];
                } else {
                   
                    $loginData = [
                        'user_id'    => null, 
                        'ip_address' => $ipAddress,
                        'status'     => 'Failure',
                        'attempted_username' => $_POST['username'] ?? $_POST['email'] ?? '',
                    ];
                }
                
                $loginModel->save($loginData);  
                $data['errors'] = ['Invalid username/email or password'];
            }
        }
        
        $this->view('/landingPage/login', $data);
    }
}