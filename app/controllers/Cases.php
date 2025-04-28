<?php

class Cases
{
    use Controller;

    public function __construct()
    {
        $this->requireLogin();
        $this->requireRole(['lawyer']);
    }


    public function index()
    {
        // Load the UserModel to get attorneys and juniors
        $userModel = $this->loadModel('UserModel');
       


        // Get attorneys and juniors from the database
        $attorneys = $userModel->getUsersByRole('attorney');
        $juniors = $userModel->getUsersByRole('junior');
        $clients = $userModel->getUsersByRole('client');


        // Render the "add new case" view with users data
        $this->view('/seniorCounsel/add_new_case', [
            'attorneys' => $attorneys,
            'juniors' => $juniors,
            'clients' => $clients,
            'errors' => [],
        ]);
    }

    // Add a new case
    // In app/controllers/Cases.php

    public function addCase()
    {
        // Collect POST data
        $data = [
            'client_name' => $_POST['client_name'] ?? '',
            'client_number' => $_POST['client_number'] ?? '',
            'client_email' => $_POST['client_email'] ?? '',
            'client_address' => $_POST['client_address'] ?? '',
            'case_number' => $_POST['case_number'] ?? '',
            'court' => $_POST['court'] ?? '',
            'notes' => $_POST['notes'] ?? '',
            'case_status' => 'ongoing', // Always set to 'ongoing' by default
            'priority' => $_POST['priority'] ?? 'medium'
        ];

        // Handle client selection/registration
        if (!empty($_POST['existing_client']) && $_POST['existing_client'] != 'new') {
            // Using existing client
            $clientId = (int)$_POST['existing_client'];
            $userModel = $this->loadModel('UserModel');
            $client = $userModel->getUserByID($clientId);

            if ($client) {
                $data['client_id'] = $clientId;
                $data['client_registered'] = 1;
                $data['client_name'] = $client->first_name . ' ' . $client->last_name;
                $data['client_email'] = $client->email;
                $data['client_number'] = $client->phone;
                // Keep the address from the form if provided, otherwise use client's address if available
                if (empty($data['client_address']) && !empty($client->address)) {
                    $data['client_address'] = $client->address;
                }
            }
        } else {
            // New client or unregistered client
            $data['client_registered'] = 0;
            $data['client_id'] = null;
        }

        // Handle attorney selection
        $data['attorney_id'] = !empty($_POST['attorney_id']) ? (int)$_POST['attorney_id'] : null;

        // Handle junior selection with auto-assignment logic
        if (!empty($_POST['junior_id'])) {
            $data['junior_id'] = (int)$_POST['junior_id'];
        } else {
            // Auto-assign junior with lowest case load
            $userModel = $this->loadModel('UserModel');
            $caseModel = $this->loadModel('CaseModel');
            $juniors = $userModel->getUsersByRole('junior');
            $data['junior_id'] = $caseModel->getJuniorWithLowestCaseLoad($juniors);

            // Log the auto-assignment
            if ($data['junior_id']) {
                $junior = $userModel->getUserByID($data['junior_id']);
                $juniorName = $junior ? $junior->first_name . ' ' . $junior->last_name : 'Unknown';
                $data['notes'] = ($data['notes'] ? $data['notes'] . "\n\n" : '') .
                    "Auto-assigned to junior counsel {$juniorName} based on case load.";
            }
        }

        // Save data to the database
        $caseModel = $this->loadModel('CaseModel');
        $caseModel->save($data);

        // Redirect to the home page or success page
        $_SESSION['success'] = 'Case added successfully!';
        redirect('cases/retrieveAllCases');
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

    // Soft delete a case (mark as deleted instead of removing from database)
    public function deleteCase($caseId)
    {
        // Load the CaseModel
        $caseModel = $this->loadModel('CaseModel');

        // Get the case to check its status
        $case = $caseModel->getCaseById($caseId);

        // Check if case is closed
        if ($case && $case->case_status == 'closed') {
            $_SESSION['error'] = 'Closed cases cannot be deleted.';
            redirect('cases/retrieveAllCases');
            return;
        }

        // Soft delete the case
        $caseModel->softDeleteCase($caseId);
        

        // Set success message
        $_SESSION['success'] = 'Case deleted successfully!';

        // Redirect to the cases list
        redirect('cases/retrieveAllCases');
    }

    // Optional: Add a method to view deleted cases (for admin users)
    public function viewDeletedCases()
    {
        // Check if user has admin privileges
        // This is just a placeholder - implement your own authorization logic
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            redirect('home');
        }

        // Load the CaseModel
        $caseModel = $this->loadModel('CaseModel');

        // Get all deleted cases
        $deletedCases = $caseModel->getDeletedCases();

        // Render the view with deleted cases
        $this->view('/seniorCounsel/deleted_cases', ['cases' => $deletedCases]);
    }

    // Optional: Add a method to restore deleted cases
    public function restoreCase($caseId)
    {
        // Check if user has admin privileges
        // This is just a placeholder - implement your own authorization logic
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            redirect('home');
        }

        // Load the CaseModel
        $caseModel = $this->loadModel('CaseModel');

        // Restore the case
        $caseModel->restoreCase($caseId);

        // Set success message
        $_SESSION['success'] = 'Case restored successfully!';

        // Redirect to the deleted cases list
        redirect('cases/viewDeletedCases');
    }

    //display only one case by id
    public function retrieveCase($caseId)
    {
        // Load the CaseModel and UserModel
        $caseModel = $this->loadModel('caseModel');
        $userModel = $this->loadModel('UserModel');

        // Get the case by ID
        $case = $caseModel->getCaseById($caseId);

        // If case exists, fetch related user details
        if ($case) {
            // Get attorney details if attorney_id exists
            if (!empty($case->attorney_id)) {
                $attorney = $userModel->getUserByID($case->attorney_id);
                if ($attorney) {
                    $case->attorney_name = $attorney->first_name . ' ' . $attorney->last_name;
                }
            }

            // Get junior counsel details if junior_id exists
            if (!empty($case->junior_id)) {
                $junior = $userModel->getUserByID($case->junior_id);
                if ($junior) {
                    $case->junior_counsel_name = $junior->first_name . ' ' . $junior->last_name;
                }
            }

            // Get client details if client_id exists
            if (!empty($case->client_id)) {
                $client = $userModel->getUserByID($case->client_id);
                if ($client) {
                    // Update client details if needed
                    $case->client_name = $client->first_name . ' ' . $client->last_name;
                    $case->client_email = $client->email;
                    $case->client_number = $client->phone;

                    // Only update address if it's empty in the case
                    if (empty($case->client_address) && !empty($client->address)) {
                        $case->client_address = $client->address;
                    }
                }
            }
        }

        // Load the view and pass the case data
        $this->view('/seniorCounsel/one_full_case_details', ['case' => $case]);
    }

    //get the case details by id and pass it to the view
    public function editCase($caseId)
    {
        $caseModel = $this->loadModel('CaseModel');
        $userModel = $this->loadModel('UserModel');

        $case = $caseModel->getCaseById($caseId);

        // Check if case is closed
        if ($case && $case->case_status == 'closed') {
            $_SESSION['error'] = 'Closed cases cannot be edited.';
            redirect('cases/retrieveAllCases');
            return;
        }

        $attorneys = $userModel->getUsersByRole('attorney');
        $juniors = $userModel->getUsersByRole('junior');
        $clients = $userModel->getUsersByRole('client');

        if (!$case) {
            die("Case not found or invalid ID."); // Handle missing case data
        }

        // Get attorney details if attorney_id exists
        if (!empty($case->attorney_id)) {
            $attorney = $userModel->getUserByID($case->attorney_id);
            if ($attorney) {
                $case->attorney_name = $attorney->first_name . ' ' . $attorney->last_name;
            }
        }

        // Get junior counsel details if junior_id exists
        if (!empty($case->junior_id)) {
            $junior = $userModel->getUserByID($case->junior_id);
            if ($junior) {
                $case->junior_counsel_name = $junior->first_name . ' ' . $junior->last_name;
            }
        }

        // Get client details if client_id exists
        if (!empty($case->client_id)) {
            $client = $userModel->getUserByID($case->client_id);
            if ($client) {
                // Update client details if needed
                $case->client_name = $client->first_name . ' ' . $client->last_name;
                $case->client_email = $client->email;
                $case->client_number = $client->phone;

                // Only update address if it's empty in the case
                if (empty($case->client_address) && !empty($client->address)) {
                    $case->client_address = $client->address;
                }
            }
        }

        // Pass the case data to the view
        $this->view('/seniorCounsel/edit_case', [
            'case' => $case,
            'attorneys' => $attorneys,
            'juniors' => $juniors,
            'clients' => $clients
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
            'case_number' => $_POST['case_number'] ?? '',
            'court' => $_POST['court'] ?? '',
            'notes' => $_POST['notes'] ?? '',
            'case_status' => $_POST['case_status'] ?? 'ongoing',
            'priority' => $_POST['priority'] ?? 'medium'
        ];

        // Handle client selection/registration
        if (!empty($_POST['existing_client']) && $_POST['existing_client'] != 'new') {
            // Using existing client
            $clientId = (int)$_POST['existing_client'];
            $userModel = $this->loadModel('UserModel');
            $client = $userModel->getUserByID($clientId);

            if ($client) {
                $data['client_id'] = $clientId;
                $data['client_registered'] = 1;
                $data['client_name'] = $client->first_name . ' ' . $client->last_name;
                $data['client_email'] = $client->email;
                $data['client_number'] = $client->phone;
                // Keep the address from the form if provided, otherwise use client's address if available
                if (empty($data['client_address']) && !empty($client->address)) {
                    $data['client_address'] = $client->address;
                }
            }
        } else {
            // New client or unregistered client
            $data['client_registered'] = 0;
            $data['client_id'] = null;
        }

        // Handle attorney and junior selection
        $data['attorney_id'] = !empty($_POST['attorney_id']) ? (int)$_POST['attorney_id'] : null;
        $data['junior_id'] = !empty($_POST['junior_id']) ? (int)$_POST['junior_id'] : null;

        // Update the case
        $caseModel = $this->loadModel('CaseModel');
        $caseModel->updateCase($data);

        // Redirect to a success page or the list of cases
        $_SESSION['success'] = 'Case updated successfully!';
        redirect('cases/RetrieveAllCases');
    }

    // Update case status via AJAX
    public function updateStatus($caseId, $newStatus)
    {
        // Validate the status value
        $validStatuses = ['ongoing', 'closed'];
        if (!in_array($newStatus, $validStatuses)) {
            echo json_encode(['success' => false, 'message' => 'Invalid status value']);
            return;
        }

        // Load the case model
        $caseModel = $this->loadModel('CaseModel');

        // Get the case to make sure it exists
        $case = $caseModel->getCaseById($caseId);
        if (!$case) {
            echo json_encode(['success' => false, 'message' => 'Case not found']);
            return;
        }

        // Update the case status
        $data = [
            'id' => $caseId,
            'case_status' => $newStatus
        ];

        $result = $caseModel->updateCaseStatus($data);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update case status']);
        }
    }

    // Search cases
    public function searchCases()
    {
        // Get search parameters from POST
        $query = $_POST['query'] ?? '';
        $field = $_POST['field'] ?? 'all';

        // Load the CaseModel
        $caseModel = $this->loadModel('CaseModel');

        // Get search results
        $cases = $caseModel->searchCases($query, $field);

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'cases' => $cases]);
        exit;
    }
}
