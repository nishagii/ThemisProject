<?php

// HomeLawyer class
class HomeLawyer
{
    use Controller;

    public function __construct()
    {
        // Require login for all methods in this controller
        $this->requireLogin();
        $this->requireRole(['lawyer']);
    }

    public function index()
    {


        // Set username from session, or default to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $caseModel = $this->loadModel('CaseModel');
        $paymentModel = $this->loadModel('PaymentModel');

        $ongoingCasesCount = $caseModel->getOngoingCasesCount();
        $totalAmount = $paymentModel->getTotalAmountReceivedInMonth();
        $delayedCases = $caseModel->getDelayedCases();

        // Load the view with data
        $this->view('/seniorCounsel/home',[
            'ongoingCasesCount' => $ongoingCasesCount,
            'totalAmount' => $totalAmount,
            'delayedCases' => $delayedCases,

        ] 
    );
    }
}
