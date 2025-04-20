<?php

class Cases
{
    use Controller;

    public function index()
    {
        // Load the UserModel to get attorneys and juniors
        $userModel = $this->loadModel('UserModel');

        // Get attorneys and juniors from the database
        $attorneys = $userModel->getUsersByRole('attorney');
        $juniors = $userModel->getUsersByRole('junior');

        // Render the "add new case" view with users data
        $this->view('/seniorCounsel/add_new_case', [
            'attorneys' => $attorneys,
            'juniors' => $juniors,
            'errors' => []
        ]);
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
            'junior_counsel_name' => $_POST['junior_counsel_name'] ?? '',
            'case_number' => $_POST['case_number'] ?? '',
            'court' => $_POST['court'] ?? '',
            'notes' => $_POST['notes'] ?? '',
        ];

        // Save data to the database
        $caseModel = $this->loadModel('CaseModel');
        $caseModel->save($data);

        // Redirect to the home page or success page
        $_SESSION['success'] = 'Case added successfully!';
        redirect('cases/extendRetrieveAllCases');
    }

    // Rest of the code remains the same...
    public function retrieveAllCases()
    {
        $caseModel = $this->loadModel('CaseModel'); // Ensure correct model loading
        $cases = $caseModel->getAllCases(); // Fetch cases data

        // Pass data to the view
        $this->view('/seniorCounsel/all_cases', ['cases' => $cases]);
    }

    // Retrieve all cases
    public function extendRetrieveAllCases()
    {
        // Load the CaseModel
        $caseModel = $this->loadModel('CaseModel');

        // Fetch all cases
        $cases = $caseModel->getAllCases();

        // Load the view and pass the cases data
        $this->view('/seniorCounsel/extended_case_details', ['cases' => $cases]);
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
        $this->view('/seniorCounsel/one_full_case_details', ['case' => $case]);
    }

    //get the case details by id and pass it to the view
    public function editCase($caseId)
    {
        $caseModel = $this->loadModel('CaseModel');
        $userModel = $this->loadModel('UserModel');

        $case = $caseModel->getCaseById($caseId);
        $attorneys = $userModel->getUsersByRole('attorney');
        $juniors = $userModel->getUsersByRole('junior');

        if (!$case) {
            die("Case not found or invalid ID."); // Handle missing case data
        }

        // Pass the case data to the view
        $this->view('/seniorCounsel/edit_case', [
            'case' => $case,
            'attorneys' => $attorneys,
            'juniors' => $juniors
        ]);
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
            'junior_counsel_name' => $_POST['junior_counsel_name'] ?? '',
            'case_number' => $_POST['case_number'] ?? '',
            'court' => $_POST['court'] ?? '',
            'notes' => $_POST['notes'] ?? '',
        ];

        // Update the case
        $caseModel = $this->loadModel('CaseModel');
        $caseModel->updateCase($data);

        // Redirect to a success page or the list of cases
        redirect('cases/extendRetrieveAllCases');
    }
}
