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
        $data['cases'] = $caseModel->getCasesByClientId($_SESSION['user_id']); 

        //invoice model 
        $invoiceModel = $this->loadModel('invoiceModel');
        $data['invoices'] = $invoiceModel->getSentInvoicesByClient($_SESSION['user_id']);

        $loginModel = $this->loadModel('LoginModel');
        $data['logins'] = $loginModel->getLoginDetailsByUserId($_SESSION['user_id']);

        $meetingModel = $this->loadModel('meetingModel');
        $data['meetings'] = $meetingModel->getMeetingsByClientId($_SESSION['user_id']);

        $this->view('/client/home', $data);
    }
}
