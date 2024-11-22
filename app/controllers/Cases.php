<?php

class Cases
{

    use Controller;

    public function index()
    {
        // Render the "add new case" view with an empty errors array
        $this->view('seniorCounsel/add_new_case');
    }

    // Add a new case
    public function addCase()
    {
        // Collect POST data
        $data = [
            'client_name' => $_POST['client_name'] ?? '',
            'client_number' => $_POST['client_number'] ?? '',
            'client_email' => $_POST['client_email'] ?? '',
            'client_address' => $_POST['client_address'] ?? '',
            'attorney_name' => $_POST['attorney_name'] ?? '',
            'attorney_number' => $_POST['attorney_number'] ?? '',
            'attorney_email' => $_POST['attorney_email'] ?? '',
            'attorney_address' => $_POST['attorney_address'] ?? '',
            'junior_counsel_name' => $_POST['junior_counsel_name'] ?? '',
            'junior_counsel_number' => $_POST['junior_counsel_number'] ?? '',
            'junior_counsel_email' => $_POST['junior_counsel_email'] ?? '',
            'junior_counsel_address' => $_POST['junior_counsel_address'] ?? '',
            'case_number' => $_POST['case_number'] ?? '',
            'court' => $_POST['court'] ?? '',
            'notes' => $_POST['notes'] ?? '',
        ];

        // Save data to the database (assuming a "Case" model exists)
        $caseModel = $this->loadModel('CaseModel');
        $caseModel->save($data);

        // Redirect to the home page or success page
        redirect('homelawyer');
    }

    // Retrieve all cases
    public function retrieveAllCases()
    {
        // Load the CaseModel
        $caseModel = $this->loadModel('CaseModel');

        // Fetch all cases
        $cases = $caseModel->getAllCases();

        // Load the view and pass the cases data
        $this->view('all_cases', ['cases' => $cases]);
    }

    // Retrieve all cases
    public function extendRetrieveAllCases()
    {
        // Load the CaseModel
        $caseModel = $this->loadModel('CaseModel');

        // Fetch all cases
        $cases = $caseModel->getAllCases();

        // Load the view and pass the cases data
        $this->view('extended_case_details', ['cases' => $cases]);
    }

    // Delete a case
    public function deleteCase($caseId)
    {
        // Load the CaseModel
        $caseModel = $this->loadModel('CaseModel');

        // Delete the case
        $caseModel->deleteCase($caseId);

        // Redirect to the home page or success page
        redirect('cases/retrieveAllCases');
    }

    //display only one case by id
    public function retrieveCase($caseId)
    {
        // Load the CaseModel
        $caseModel = $this->loadModel('caseModel');
        // Get the case by ID
        $case = $caseModel->getCaseById($caseId);
        // Load the view and pass the case data
        $this->view('one_full_case_details', ['case' => $case]);
    }

    //get the case details by id and pass it to the view
    public function editCase($caseId)
    {
        $caseModel = $this->loadModel('CaseModel');

        $case = $caseModel->getCaseById($caseId);


        // Debugging: Output the $case variable to check its content
        // var_dump($case);
        // die(); // Stop execution after dumping the data to see the output


        if (!$case) {
            die("Case not found or invalid ID."); // Handle missing case data
        }

        // Pass the case data to the view
        $this->view('edit_case', ['case' => $case]);
    }

    // Handle case update
    public function updateCase()
    {
        // Collect POST data
        $data = [
            'id' => $_POST['id'], // Include the ID for update
            'client_name' => $_POST['client_name'] ?? '',
            'client_number' => $_POST['client_number'] ?? '',
            'client_email' => $_POST['client_email'] ?? '',
            'client_address' => $_POST['client_address'] ?? '',
            'attorney_name' => $_POST['attorney_name'] ?? '',
            'attorney_number' => $_POST['attorney_number'] ?? '',
            'attorney_email' => $_POST['attorney_email'] ?? '',
            'attorney_address' => $_POST['attorney_address'] ?? '',
            'junior_counsel_name' => $_POST['junior_counsel_name'] ?? '',
            'junior_counsel_number' => $_POST['junior_counsel_number'] ?? '',
            'junior_counsel_email' => $_POST['junior_counsel_email'] ?? '',
            'junior_counsel_address' => $_POST['junior_counsel_address'] ?? '',
            'case_number' => $_POST['case_number'] ?? '',
            'court' => $_POST['court'] ?? '',
            'notes' => $_POST['notes'] ?? '',
        ];

        // Update the case
        $caseModel = $this->loadModel('CaseModel');
        $caseModel->updateCase($data);

        // Redirect to a success page or the list of cases
        redirect('cases/retrieveCases');
    }
}
