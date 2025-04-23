<?php

class HomeClient
{
    use Controller;

    public function index()
    {
        if (empty($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        $data['username'] = $_SESSION['username'] ?? 'User';

        // Load case model and fetch cases
        $caseModel = $this->loadModel('CaseModel');
        $data['cases'] = $caseModel->getCasesByClientId($_SESSION['user_id']); // fixed: added assignment and semicolon

        $this->view('/client/home', $data);
    }
}
