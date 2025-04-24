<?php
class HomeJunior
{
    use Controller;

    public function index()
    {
        
        if (empty($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        $caseModel = $this->loadModel('caseModel');
        $data['cases'] = $caseModel->getCasesByJuniorId($_SESSION['user_id']);

        $data['username'] = $_SESSION['username'] ?? 'User';
        $this->view('/juniorCounsel/home', $data);
    }
}

