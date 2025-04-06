<?php

class Document
{

    use Controller;

    public function index()
    {
        
            //change this later 
        $caseID = 11; 
        
        
        $documentModel = $this->loadModel('documentModel');
        $documents = $documentModel->getDocumentsByCase($caseID);
        $this->view('/seniorCounsel/case_documents', ['documents' => $documents]);
    }

    public function add_Document()
    {
        $this->view('/seniorCounsel/document_upload');
    }

    public function save_Document() {
        $documentModel = $this->loadModel('documentModel');
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Collect and sanitize form data
            $docName = filter_input(INPUT_POST, 'doc_name', FILTER_SANITIZE_STRING);
            $docDescription = filter_input(INPUT_POST, 'doc_description', FILTER_SANITIZE_STRING);
            
            // Set default values for case_id and uploaded_by
            $caseID = 11; // Default case_id, replace with actual case ID or from session
            $uploadedBy = 1; // Default uploaded_by, should be from session
            
            // Check if a file was uploaded
            if (isset($_FILES['document_file']) && $_FILES['document_file']['error'] === UPLOAD_ERR_OK) {
                // Create a unique filename to avoid overwriting
                $fileName = uniqid() . '_' . basename($_FILES['document_file']['name']);
                
                // Define your upload folder with proper path
                $targetDir = "../public/assets/documents/";
                
                // Create directory if it doesn't exist
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                
                $targetFile = $targetDir . $fileName;
                $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                
                // Check file type
                $allowedTypes = ['pdf', 'docx', 'txt'];
                if (!in_array($fileType, $allowedTypes)) {
                    $_SESSION['error'] = "Only PDF, DOCX, and TXT files are allowed.";
                    header("Location: " . ROOT . "/document/add_Document");
                    exit;
                }
                
                // Move the uploaded file
                if (move_uploaded_file($_FILES['document_file']['tmp_name'], $targetFile)) {
                    // Prepare data for database
                    $documentData = [
                        'case_id' => $caseID,
                        'doc_name' => $docName,
                        'doc_description' => $docDescription,
                        'file_path' => $fileName, // Just store the filename, not the full path
                        'uploaded_by' => $uploadedBy,
                    ];
                    
                    // Debug: Print the data to see what's being sent
                    // echo "<pre>"; print_r($documentData); echo "</pre>"; exit;
                    
                    // Use the DocumentModel to save
                    $documentModel = new DocumentModel();
                    $result = $documentModel->save($documentData);
                    
                    if ($result) {
                        $_SESSION['success'] = "Document uploaded successfully!";
                        header("Location: " . ROOT . "/document/index");
                        exit;
                    } else {
                        $_SESSION['error'] = "Database error. Could not save document information.";
                        header("Location: " . ROOT . "/document/add_Document");
                        exit;
                    }
                } else {
                    $_SESSION['error'] = "Error moving uploaded file.";
                    header("Location: " . ROOT . "/document/add_Document");
                    exit;
                }
            } else {
                // Get the specific error
                $uploadError = $_FILES['document_file']['error'];
                $_SESSION['error'] = "File upload error: " . $this->getFileUploadErrorMessage($uploadError);
                header("Location: " . ROOT . "/document/add_Document");
                exit;
            }
        } else {
            header("Location: " . ROOT . "/document/add_Document");
            exit;
        }
    }
    
    // Helper function to translate file upload error codes
    private function getFileUploadErrorMessage($errorCode) {
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
                return "The uploaded file exceeds the upload_max_filesize directive in php.ini";
            case UPLOAD_ERR_FORM_SIZE:
                return "The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form";
            case UPLOAD_ERR_PARTIAL:
                return "The uploaded file was only partially uploaded";
            case UPLOAD_ERR_NO_FILE:
                return "No file was uploaded";
            case UPLOAD_ERR_NO_TMP_DIR:
                return "Missing a temporary folder";
            case UPLOAD_ERR_CANT_WRITE:
                return "Failed to write file to disk";
            case UPLOAD_ERR_EXTENSION:
                return "A PHP extension stopped the file upload";
            default:
                return "Unknown upload error";
        }
    }



    public function retrieveCaseDocuments()
    {
        
    }


    // Delete a document
    public function deleteDocument($documentID)
    {
        
    }

    //display only one document by id
    public function retrieveDocumentByID($documentID)
    {
        
    }

    
    public function editDocument($documentID)
    {

    }

    // Handle  update
    public function updateDocument()
    {
 

        
    }
}
