<?php

class SCrules {
    use Controller;

    private $SCrulesModel;

    public function __construct() {
        $this->SCrulesModel = $this->loadModel('SCrulesModel');
    }

    public function index()
    {
        
    }

/*---------------------Create operation----------------------------- */
public function create() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $uploadDir = '../public/assets/scrulesUploads/';
        $allowedTypes = ['application/pdf'];

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        function uploadFile($fileInputName, $uploadDir, $allowedTypes) {
            if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES[$fileInputName]['tmp_name'];
                $fileName = basename($_FILES[$fileInputName]['name']);
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $fileType = $_FILES[$fileInputName]['type'];

                // Validate file type
                if (!in_array($fileType, $allowedTypes)) {
                    die("Invalid file type for $fileInputName. Please upload a PDF.");
                }

                // Sanitize and create unique file name
                $sanitizedFileName = uniqid($fileInputName . '_', true) . '.' . $fileExtension;
                $uploadPath = $uploadDir . $sanitizedFileName;

                if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                    return '/themisrepo/public/assets/scrulesUploads/' . $sanitizedFileName;
                } else {
                    die("File upload failed for $fileInputName. Please try again.");
                }
            }
            return null;
        }

        $sinhalaLink = uploadFile('sinhala_link', $uploadDir, $allowedTypes);
        $tamilLink = uploadFile('tamil_link', $uploadDir, $allowedTypes);
        $englishLink = uploadFile('english_link', $uploadDir, $allowedTypes);

        // Prepare data for insertion
        $data = [
            'rule_number' => $_POST['rule_number'],
            'published_date' => $_POST['published_date'],
            'sinhala_link' => $sinhalaLink,
            'tamil_link' => $tamilLink,
            'english_link' => $englishLink
        ];

        // Insert into database
        $this->SCrulesModel->insert($data);
    }

    $this->view('precedentsAdmin/create_scrule');
}

/*--------------------Retrieve------------------------------- */

    public function retrieve(){
        $rulesModel = $this->loadModel('SCrulesModel'); 
        $rules = $rulesModel->getAll();

        // Pass data to the view
        $this->view('precedentsAdmin/SCrules', ['rules' => $rules]);
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
        'description' => $_POST['description'],
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