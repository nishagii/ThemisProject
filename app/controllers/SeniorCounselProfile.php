<?php
class SeniorCounselProfile {
    use Controller;
    
    public function __construct()
    {
        $this->requireLogin();
        $this->requireRole(['lawyer']);
    }
    
    public function index()
    {
        // Get the current logged in user ID from session
        $user_id = $_SESSION['user_id'] ?? null;
        
        if (!$user_id) {
            
            redirect('login');
            return;
        }
        
        // Basic user data
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
        
       
        $loginModel = $this->loadModel('LoginModel');
        
        // Get login history for this user
        $data['login_history'] = $loginModel->getLoginDetailsByUserId($user_id);
        
        // Load the views with data
        $this->view('/seniorCounsel/component/bigNav', $data);
        $this->view('/seniorCounsel/component/smallNav1', $data);
        $this->view('/seniorCounsel/component/sidebar', $data);
        
        $this->view('profileComponent', $data);
    }
}