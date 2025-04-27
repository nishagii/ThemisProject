<?php

// ReportsAdmin class
class Report
{
    use Controller;

    public function __construct()
    {
        $this->requireLogin();
        $this->requireRole(['admin']);
    }

    public function index()
    {
        if (empty($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
            redirect('login');
            return;
        }

        $data['username'] = $_SESSION['username'] ?? 'User';

        // Load necessary models
       
        $userModel = $this->loadModel('UserModel');

        // Get recent reports
       

        // User counts for context
        $data['total_users'] = $userModel->countUsers();
        $data['total_clients'] = $userModel->countClients();
        
        // Load the view with data
        $this->view('/admin/report', $data);
    }

    
}