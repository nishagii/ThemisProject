<?php

class CaseJunior
{

    use Controller;

    public function index()
    {
        // Render the "add new case" view with an empty errors array
        $this->view('/juniorCounsel/case');
    }


    public function retrieveAllCases()
    {
        $caseModel = $this->loadModel('CaseModel'); // Ensure correct model loading
        $cases = $caseModel->getAllCases(); // Fetch cases data

        // Pass data to the view
        $this->view('/juniorCounsel/case', ['cases' => $cases]);
    }

    // Retrieve all cases
    public function extendRetrieveAllCases()
    {
        // Load the CaseModel
        $caseModel = $this->loadModel('CaseModel');

        // Fetch all cases
        $cases = $caseModel->getAllCases();

        // Load the view and pass the cases data
        $this->view('/juniorCounsel/extended_case_details', ['cases' => $cases]);
    }


    //display only one case by id
    public function retrieveCase($caseId)
    {
        // Load the CaseModel
        $caseModel = $this->loadModel('caseModel');
        // Get the case by ID
        $case = $caseModel->getCaseById($caseId);
        // Load the view and pass the case data
        $this->view('/juniorCounsel/one_full_case_details', ['case' => $case]);
    }


}
