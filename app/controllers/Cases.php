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
        
        $userModel = $this->loadModel('UserModel');
       


  
        $attorneys = $userModel->getUsersByRole('attorney');
        $juniors = $userModel->getUsersByRole('junior');
        $clients = $userModel->getUsersByRole('client');


        
        $this->view('/seniorCounsel/add_new_case', [
            'attorneys' => $attorneys,
            'juniors' => $juniors,
            'clients' => $clients,
            'errors' => [],
        ]);
    }


    public function addCase()
    {
      
        $data = [
            'client_name' => $_POST['client_name'] ?? '',
            'client_number' => $_POST['client_number'] ?? '',
            'client_email' => $_POST['client_email'] ?? '',
            'client_address' => $_POST['client_address'] ?? '',
            'case_number' => $_POST['case_number'] ?? '',
            'court' => $_POST['court'] ?? '',
            'notes' => $_POST['notes'] ?? '',
            'case_status' => 'ongoing' 
        ];

 
        if (!empty($_POST['existing_client']) && $_POST['existing_client'] != 'new') {
     
            $clientId = (int)$_POST['existing_client'];
            $userModel = $this->loadModel('UserModel');
            $client = $userModel->getUserByID($clientId);

            if ($client) {
                $data['client_id'] = $clientId;
                $data['client_registered'] = 1;
                $data['client_name'] = $client->first_name . ' ' . $client->last_name;
                $data['client_email'] = $client->email;
                $data['client_number'] = $client->phone;
               
                if (empty($data['client_address']) && !empty($client->address)) {
                    $data['client_address'] = $client->address;
                }
            }
        } else {
          
            $data['client_registered'] = 0;
            $data['client_id'] = null;
        }

     
        $data['attorney_id'] = !empty($_POST['attorney_id']) ? (int)$_POST['attorney_id'] : null;

        if (!empty($_POST['junior_id'])) {
            $data['junior_id'] = (int)$_POST['junior_id'];
        } else {
            
            $userModel = $this->loadModel('UserModel');
            $caseModel = $this->loadModel('CaseModel');
            $juniors = $userModel->getUsersByRole('junior');
            $data['junior_id'] = $caseModel->getJuniorWithLowestCaseLoad($juniors);

           
            if ($data['junior_id']) {
                $junior = $userModel->getUserByID($data['junior_id']);
                $juniorName = $junior ? $junior->first_name . ' ' . $junior->last_name : 'Unknown';
                $data['notes'] = ($data['notes'] ? $data['notes'] . "\n\n" : '') .
                    "Auto-assigned to junior counsel {$juniorName} based on case load.";
            }
        }

        $caseModel = $this->loadModel('CaseModel');
        $caseModel->save($data);

     
        $_SESSION['success'] = 'Case added successfully!';
        redirect('cases/retrieveAllCases');
    }



    public function retrieveAllCases()
    {
        $caseModel = $this->loadModel('CaseModel'); 
        $cases = $caseModel->getAllCases(); 

      
        $this->view('/seniorCounsel/all_cases', ['cases' => $cases]);
    }

   
    public function extendRetrieveAllCases()
    {
        
        $caseModel = $this->loadModel('CaseModel');

        
        $cases = $caseModel->getAllCases();

        
        $this->view('/seniorCounsel/extended_case_details', ['cases' => $cases]);
    }

    
    public function deleteCase($caseId)
    {
        
        $caseModel = $this->loadModel('CaseModel');

        $case = $caseModel->getCaseById($caseId);

        if ($case && $case->case_status == 'closed') {
            $_SESSION['error'] = 'Closed cases cannot be deleted.';
            redirect('cases/retrieveAllCases');
            return;
        }

        
        $caseModel->softDeleteCase($caseId);
        

        
        $_SESSION['success'] = 'Case deleted successfully!';

        
        redirect('cases/retrieveAllCases');
    }

   
    public function viewDeletedCases()
    {
    
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            redirect('home');
        }

    
        $caseModel = $this->loadModel('CaseModel');

       
        $deletedCases = $caseModel->getDeletedCases();

       
        $this->view('/seniorCounsel/deleted_cases', ['cases' => $deletedCases]);
    }

    public function restoreCase($caseId)
    {
     
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            redirect('home');
        }

      
        $caseModel = $this->loadModel('CaseModel');

   
        $caseModel->restoreCase($caseId);

       
        $_SESSION['success'] = 'Case restored successfully!';

     
        redirect('cases/viewDeletedCases');
    }

  
    public function retrieveCase($caseId)
    {
       
        $caseModel = $this->loadModel('caseModel');
        $userModel = $this->loadModel('UserModel');

        
        $case = $caseModel->getCaseById($caseId);

       
        if ($case) {
            
            if (!empty($case->attorney_id)) {
                $attorney = $userModel->getUserByID($case->attorney_id);
                if ($attorney) {
                    $case->attorney_name = $attorney->first_name . ' ' . $attorney->last_name;
                }
            }

            
            if (!empty($case->junior_id)) {
                $junior = $userModel->getUserByID($case->junior_id);
                if ($junior) {
                    $case->junior_counsel_name = $junior->first_name . ' ' . $junior->last_name;
                }
            }

          
            if (!empty($case->client_id)) {
                $client = $userModel->getUserByID($case->client_id);
                if ($client) {
                  
                    $case->client_name = $client->first_name . ' ' . $client->last_name;
                    $case->client_email = $client->email;
                    $case->client_number = $client->phone;

                   
                    if (empty($case->client_address) && !empty($client->address)) {
                        $case->client_address = $client->address;
                    }
                }
            }
        }

     
        $this->view('/seniorCounsel/one_full_case_details', ['case' => $case]);
    }

   
    public function editCase($caseId)
    {
        $caseModel = $this->loadModel('CaseModel');
        $userModel = $this->loadModel('UserModel');

        $case = $caseModel->getCaseById($caseId);

  
        if ($case && $case->case_status == 'closed') {
            $_SESSION['error'] = 'Closed cases cannot be edited.';
            redirect('cases/retrieveAllCases');
            return;
        }

        $attorneys = $userModel->getUsersByRole('attorney');
        $juniors = $userModel->getUsersByRole('junior');
        $clients = $userModel->getUsersByRole('client');

        if (!$case) {
            die("Case not found or invalid ID.");
        }

      
        if (!empty($case->attorney_id)) {
            $attorney = $userModel->getUserByID($case->attorney_id);
            if ($attorney) {
                $case->attorney_name = $attorney->first_name . ' ' . $attorney->last_name;
            }
        }

    
        if (!empty($case->junior_id)) {
            $junior = $userModel->getUserByID($case->junior_id);
            if ($junior) {
                $case->junior_counsel_name = $junior->first_name . ' ' . $junior->last_name;
            }
        }

     
        if (!empty($case->client_id)) {
            $client = $userModel->getUserByID($case->client_id);
            if ($client) {
                
                $case->client_name = $client->first_name . ' ' . $client->last_name;
                $case->client_email = $client->email;
                $case->client_number = $client->phone;

             
                if (empty($case->client_address) && !empty($client->address)) {
                    $case->client_address = $client->address;
                }
            }
        }

       
        $this->view('/seniorCounsel/edit_case', [
            'case' => $case,
            'attorneys' => $attorneys,
            'juniors' => $juniors,
            'clients' => $clients
        ]);
    }


   
    public function updateCase()
    {
     
        $data = [
            'id' => $_POST['id'], 
            'client_name' => $_POST['client_name'] ?? '',
            'client_number' => $_POST['client_number'] ?? '',
            'client_email' => $_POST['client_email'] ?? '',
            'client_address' => $_POST['client_address'] ?? '',
            'case_number' => $_POST['case_number'] ?? '',
            'court' => $_POST['court'] ?? '',
            'notes' => $_POST['notes'] ?? '',
            'case_status' => $_POST['case_status'] ?? 'ongoing'
        ];

     
        if (!empty($_POST['existing_client']) && $_POST['existing_client'] != 'new') {

            $clientId = (int)$_POST['existing_client'];
            $userModel = $this->loadModel('UserModel');
            $client = $userModel->getUserByID($clientId);

            if ($client) {
                $data['client_id'] = $clientId;
                $data['client_registered'] = 1;
                $data['client_name'] = $client->first_name . ' ' . $client->last_name;
                $data['client_email'] = $client->email;
                $data['client_number'] = $client->phone;
               
                if (empty($data['client_address']) && !empty($client->address)) {
                    $data['client_address'] = $client->address;
                }
            }
        } else {
            
            $data['client_registered'] = 0;
            $data['client_id'] = null;
        }


        $data['attorney_id'] = !empty($_POST['attorney_id']) ? (int)$_POST['attorney_id'] : null;
        $data['junior_id'] = !empty($_POST['junior_id']) ? (int)$_POST['junior_id'] : null;


        $caseModel = $this->loadModel('CaseModel');
        $caseModel->updateCase($data);

        
        $_SESSION['success'] = 'Case updated successfully!';
        redirect('cases/RetrieveAllCases');
    }

    
    public function updateStatus($caseId, $newStatus)
    {

        $validStatuses = ['ongoing', 'closed'];
        if (!in_array($newStatus, $validStatuses)) {
            echo json_encode(['success' => false, 'message' => 'Invalid status value']);
            return;
        }

        
        $caseModel = $this->loadModel('CaseModel');

    
        $case = $caseModel->getCaseById($caseId);
        if (!$case) {
            echo json_encode(['success' => false, 'message' => 'Case not found']);
            return;
        }

      
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


    public function searchCases()
    {
       
        $query = $_POST['query'] ?? '';
        $field = $_POST['field'] ?? 'all';

      
        $caseModel = $this->loadModel('CaseModel');

       
        $cases = $caseModel->searchCases($query, $field);

      
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'cases' => $cases]);
        exit;
    }
}
