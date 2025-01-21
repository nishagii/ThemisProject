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
        // File upload logic
        $documentLink = '';  // Default value if no file is uploaded
        if (isset($_FILES['document_link']) && $_FILES['document_link']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../public/assets/precedentsUploads/';
            $fileName = basename($_FILES['document_link']['name']);
            $fileTmpPath = $_FILES['document_link']['tmp_name'];
            $fileType = $_FILES['document_link']['type'];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            // Define allowed file types
            $allowedTypes = ['application/pdf'];


            // Sanitize and create unique file name
            $sanitizedFileName = uniqid('precedent_', true) . '.' . $fileExtension;
            $uploadPath = $uploadDir . $sanitizedFileName;

            // Ensure directory exists
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            // Validate file type
            if (!in_array($fileType, $allowedTypes)) {
                die("Invalid file type. Please upload a PDF or Word document.");
            }
            // Move the uploaded file to the desired directory
            if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                // Save the relative path to the database
                $documentLink = '/themisrepo/public/assets/precedentsUploads/' . $sanitizedFileName;
            } else {
                die('File upload failed. Please try again.');
            }
        }

        // Prepare data for insertion
        $data = [
            'judgment_date' => $_POST['judgment_date'],
            'case_number' => $_POST['case_number'],
            'name_of_parties' => $_POST['parties'],
            'judgment_by' => $_POST['judgment_by'],
            'document_link' => $documentLink  // Use the correct variable here
        ];

        // Insert into database
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

    public function updatePrecedent(){
    // Collect POST data
    $data = [
        'judgment_date' => $_POST['judgment_date'],
        'case_number' => $_POST['case_number'],
        'name_of_parties' => $_POST['name_of_parties'],
        'judgment_by' => $_POST['judgment_by'],
        'document_link' => $_POST['current_document_link'], // Keep this for the case where no file is uploaded
        'id' => $_POST['id'],
    ];

    // Check if a file was uploaded
    if (isset($_FILES['document_upload']) && $_FILES['document_upload']['error'] === UPLOAD_ERR_OK) {
        // Define allowed file types
        $allowedTypes = ['application/pdf'];

        $fileTmpPath = $_FILES['document_upload']['tmp_name'];
        $fileName = $_FILES['document_upload']['name'];
        $fileType = $_FILES['document_upload']['type'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Validate file type
        if (!in_array($fileType, $allowedTypes)) {
            die("Invalid file type. Please upload a PDF or Word document.");
        }

        $uploadDir = '../public/assets/precedentsUploads/';
        $sanitizedFileName = uniqid('precedent_', true) . '.' . $fileExtension;
        $uploadPath = $uploadDir . $sanitizedFileName;

        // Move the uploaded file to the server
        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                // Save the relative path to the database
                $data['document_link'] = '/themisrepo/public/assets/precedentsUploads/' . $sanitizedFileName;
            } else {
                die('File upload failed. Please try again.');
        }
    }

    // Update the case in the database
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