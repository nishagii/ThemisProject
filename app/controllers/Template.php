<?php


class Template
{
    use Controller;

    private $templateModel;

    public function __construct() {
        $this->templateModel = $this->loadModel('templateModel');
    }

    public function index()
    {

        // Set username from session, or default to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        // Load the view with data
        $this->view('/seniorCounsel/template', $data);
    }

/*---------------------Create operation----------------------------- */
public function create() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // File upload logic
        $documentLink = '';  // Default value if no file is uploaded
        if (isset($_FILES['document_link']) && $_FILES['document_link']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../public/assets/templateUploads/';
            $fileName = basename($_FILES['document_link']['name']);
            $fileTmpPath = $_FILES['document_link']['tmp_name'];
            $fileType = $_FILES['document_link']['type'];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            // Define allowed file types
            $allowedTypes = ['application/pdf'];

            // Sanitize and create unique file name
            $sanitizedFileName = uniqid('template_', true) . '.' . $fileExtension;
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
                $documentLink = '/themisrepo/public/assets/templateUploads/' . $sanitizedFileName;
            } else {
                die('File upload failed. Please try again.');
            }
        }

        // Prepare data for insertion
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'document_link' => $documentLink
        ];

        // Insert into database
        $this->templateModel->insert($data);
    }

    $this->view('seniorCounsel/add_template');
}    

/*------------------------------retrieve function ------------------------------------*/
    public function retrieve()
    {
        $templateModel = $this->loadModel('templateModel'); 
        $templates = $templateModel->getAll();

        // Pass data to the view
        $this->view('seniorCounsel/template', ['templates' => $templates]);
    }
    /*------------------------------Download function ------------------------------------*/
    public function download($id){
        $template = $this->templateModel->getById($id);

        if ($template && file_exists('../' . $template->document_link)) {
            $filePath = '../' . $template->document_link;
            $fileName = basename($filePath);

            // Set headers for download
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));

            // Read and output the file
            readfile($filePath);
            exit;
        } else {
            // echo "File not found.";
            http_response_code(404);
        }
    }
/*-------------------Update---------------------------------- */
   
public function edit($id) {
    $templateModel = $this->loadModel('templateModel');
    $template = $templateModel->getById($id);

    if (!$template) {
        die("Case not found or invalid ID.");
    }
    $this->view('seniorCounsel/edit_template', ['template' => $template]);
}

public function updateTemplate(){
// Collect POST data
$data = [
    'name' => $_POST['Name'],
    'description' => $_POST['Description'],
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

    $uploadDir = '../public/assets/templateUploads/';
    $sanitizedFileName = uniqid('template_', true) . '.' . $fileExtension;
    $uploadPath = $uploadDir . $sanitizedFileName;

    // Move the uploaded file to the server
    if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            // Save the relative path to the database
            $data['document_link'] = '/themisrepo/public/assets/templateUploads/' . $sanitizedFileName;
        } else {
            die('File upload failed. Please try again.');
    }
    }

// Update the case in the database
$templateModel = $this->loadModel('templateModel');
$templateModel->update($data);

// Redirect to a success page or the list of cases
redirect('template/retrieve');
}
}
