<?php

class CaseJunior
{

    use Controller;

    public function index()

    {   
        // Load the CaseModel
        $caseModel = $this->loadModel('caseModel');
        // Get the case by ID
        $cases = $caseModel->getAllCases();
        // Load the view and pass the case data
        // Render the "add new case" view with an empty errors array
        $this->view('/juniorCounsel/case', ['cases' => $cases]);
    }

}

