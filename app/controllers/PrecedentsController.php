<?php

class PrecedentsController {
    use Controller;

    private $precedentModel;

    public function __construct() {
        $this->precedentModel = $this->loadModel('PrecedentModel');
    }

    public function index()
    {
        $this->view('/precedentsAdmin/PrecedentsAdmin_Home');
    }
    
/*---------------------Create operation----------------------------- */
    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'judgment_date' => $_POST['judgment_date'],
                'case_number' => $_POST['case_number'],
                'parties' => $_POST['parties'],
                'judgment_by' => $_POST['judgment_by'],
                'document_link' => $_POST['document_link']
            ];
            
            $this->precedentModel->insert($data);
        }
        
        $this->view('precedentsAdmin/create_precedent');
    }

/*--------------------Retrieve------------------------------- */
    public function retrieveAll()
    {
        $caseModel = $this->loadModel('PrecedentModel'); 
        $cases = $caseModel->getAll();

        // Pass data to the view
        $this->view('precedentsAdmin/all_precedents', ['cases' => $cases]);
    }

    public function retrieveOne($id)
    {
        if ($id === null) {
            echo "Case number is required.";
            return;
        }

        $caseModel = $this->loadModel('PrecedentModel');
        // Get the case by case number
        $case = $caseModel->getByCaseId($id);
        // Handle case not found
        if ($case === null) {
            echo "<p>Case with ID {$id} not found.</p>";
            return;
        }
        // Load the view and pass the case data
        $this->view('precedentsAdmin/one_precedent', ['case' => $case]);
    }

    //view only
    public function retrieveAllViewOnly()
    {
        $caseModel = $this->loadModel('PrecedentModel'); 
        $cases = $caseModel->getAll();

        // Pass data to the view
        $this->view('all_precedents_viewOnly', ['cases' => $cases]);
    }
    public function retrieveOneViewOnly($id)
    {
        if ($id === null) {
            echo "Case number is required.";
            return;
        }

        $caseModel = $this->loadModel('PrecedentModel');
        // Get the case by case number
        $case = $caseModel->getByCaseId($id);
        // Handle case not found
        if ($case === null) {
            echo "<p>Case with ID {$id} not found.</p>";
            return;
        }
        // Load the view and pass the case data
        $this->view('one_precedent_viewOnly', ['case' => $case]);
    }
/*-------------------Update---------------------------------- */
   
    public function edit($id) {
        $caseModel = $this->loadModel('PrecedentModel');
        $case = $caseModel->getByCaseId($id);

        if (!$case) {
            die("Case not found or invalid ID.");
        }
        $this->view('precedentsAdmin/edit_precedent', ['case' => $case]);
    }

    public function updatePrecedent()
    {
        // Collect POST data
        $data = [
            'judgment_date' => $_POST['judgment_date'],
            'case_number' => $_POST['case_number'],
            'name_of_parties' => $_POST['name_of_parties'],
            'judgment_by' => $_POST['judgment_by'],
            'document_link' => $_POST['document_link'],
            'id' => $_POST['id'],
        ];

        // Update the case
        $caseModel = $this->loadModel('PrecedentModel');
        $caseModel->update($data);

        // Redirect to a success page or the list of cases
        redirect('PrecedentsController/retrieveAll');
    }
/*-------------------Delete----------------------------------- */
    public function deletePrecedent($id)
    {
        // Load the CaseModel
        $caseModel = $this->loadModel('PrecedentModel');

        // Delete the case
        $caseModel->delete($id);

        // Redirect to the home page or success page
        redirect('PrecedentsController/retrieveAll');
    }
}