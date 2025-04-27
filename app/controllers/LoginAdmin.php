<?php

// HomeAdmin class
class LoginAdmin
{
    use Controller;

    public function __construct()
    {
       
        $this->requireLogin();
        $this->requireRole(['admin']);
    }

    public function index()
    {

        
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
        $loginModel = $this->loadModel('LoginModel');  

        $data['login'] = $loginModel->getAllLoginDetails();

        // Load the view with data
        $this->view('/admin/loginActivity', $data);
    }
}
