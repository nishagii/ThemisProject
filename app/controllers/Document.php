<?php

class Document
{
    use Controller;

    public function index($caseID)
    {
        if (empty($_SESSION['user_id'])) {
            redirect('login');
            return;
        }
    
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'] ?? 'User';
    
        $documentModel = $this->loadModel('documentModel');
        $documents = $documentModel->getDocumentsByCase($caseID);
    
        // Pass both documents and user data to the view
        $this->view('/seniorCounsel/case_documents', [
            'documents' => $documents,
            'user_id' => $user_id,
            'username' => $username,
            'case_id' => $caseID
        ]);
    }
    

    public function add_Document($caseID)
    {
        if (empty($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'] ?? 'User';

        $this->view('/seniorCounsel/document_upload', [
            'user_id' => $user_id,
            'username' => $username,
            'case_id' =>  $caseID
        ]);
    }


    public function save_Document() {
        if (empty($_SESSION['user_id'])) {
            redirect('login');
            return;
        }
    
        $documentModel = $this->loadModel('documentModel');
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $docName = filter_input(INPUT_POST, 'doc_name', FILTER_SANITIZE_STRING);
            $docDescription = filter_input(INPUT_POST, 'doc_description', FILTER_SANITIZE_STRING);
    
            $caseID = filter_input(INPUT_POST, 'case_id', FILTER_SANITIZE_NUMBER_INT); 
            $uploadedBy = $_SESSION['user_id'] ?? null;
    
            if (isset($_FILES['document_file']) && $_FILES['document_file']['error'] === UPLOAD_ERR_OK) {
                $fileName = uniqid() . '_' . basename($_FILES['document_file']['name']);
                $targetDir = "../public/assets/documents/";
    
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
    
                $targetFile = $targetDir . $fileName;
                $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
                $allowedTypes = ['pdf', 'docx', 'txt'];
                if (!in_array($fileType, $allowedTypes)) {
                    $_SESSION['error'] = "Only PDF, DOCX, and TXT files are allowed.";
                    header("Location: " . ROOT . "/document/add_Document");
                    exit;
                }
    
                if (move_uploaded_file($_FILES['document_file']['tmp_name'], $targetFile)) {
                    $documentData = [
                        'case_id' => $caseID,
                        'doc_name' => $docName,
                        'doc_description' => $docDescription,
                        'file_path' => $fileName,
                        'uploaded_by' => $uploadedBy,
                    ];
    
                    $result = $documentModel->save($documentData);
    
                    if ($result) {
                        $_SESSION['success'] = "Document uploaded successfully!";
                        header("Location: " . ROOT . "/document/index/$caseID");
                        exit;
                    } else {
                        $_SESSION['error'] = "Database error. Could not save document information.";
                        header("Location: " . ROOT . "/document/add_Document/$caseID");
                        exit;
                    }
                } else {
                    $_SESSION['error'] = "Error moving uploaded file.";
                    header("Location: " . ROOT . "/document/add_Document/$caseID");
                    exit;
                }
            } else {
                $uploadError = $_FILES['document_file']['error'];
                $_SESSION['error'] = "File upload error: " . $this->getFileUploadErrorMessage($uploadError);
                header("Location: " . ROOT . "/document/add_Document/$caseID");
                exit;
            }
        } else {
            header("Location: " . ROOT . "/Cases");
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
        // Get case ID from URL or session
        $caseID = $_GET['case_id'] ?? 11; // Default to 11 if not provided
        
        // Load model and get documents
        $documentModel = $this->loadModel('documentModel');
        $documents = $documentModel->getDocumentsByCase($caseID);
        
        // Return the documents as JSON or render a view
        echo json_encode($documents);
    }

    // Delete a document
    public function deleteDocument($documentID)
    {
        // Load the document model
        $documentModel = $this->loadModel('documentModel');
        
        // Get document info before deleting (to delete the file as well)
        $document = $documentModel->getDocumentById($documentID)[0] ?? null;
        
        if (!$document) {
            $_SESSION['error'] = "Document not found.";
            header("Location: " . ROOT . "/document/index");
            exit;
        }
        
        // Delete the document record from database
        $result = $documentModel->delete($documentID);
        
        if ($result) {
            // Also delete the physical file if it exists
            $filePath = "../public/assets/documents/" . $document->file_path;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            
            $_SESSION['success'] = "Document deleted successfully!";
        } else {
            $_SESSION['error'] = "Failed to delete the document.";
        }
        
        // Redirect back to documents list
        header("Location: " . ROOT . "/document/index");
        exit;
    }

    // Display only one document by id
    public function retrieveDocumentByID($documentID)
    {
        // Load the document model
        $documentModel = $this->loadModel('documentModel');
        
        // Get document by ID
        $document = $documentModel->getDocumentById($documentID)[0] ?? null;
        
        if (!$document) {
            $_SESSION['error'] = "Document not found.";
            header("Location: " . ROOT . "/document/index");
            exit;
        }
        
        // Display document details, you can create a view for this
        $this->view('/seniorCounsel/document_details', ['document' => $document]);
    }
    
    public function editDocument($id)
    {
        $documentModel = $this->loadModel('documentModel');
        
        $document = $documentModel->getDocumentById($id); // Fetch by ID

        
        if ($document) {
            $this->view('seniorCounsel/edit_document', ['document' => $document]);
        } else {
            // Optionally show 404 or redirect
            echo "Document not found!";
        }
    }
    

    // Handle update
    public function updateDocument()
    {
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . ROOT . "/document/index");
            exit;
        }
        
        // Get document ID and other form data
        $documentID = filter_input(INPUT_POST, 'document_id', FILTER_SANITIZE_NUMBER_INT);
        $docName = filter_input(INPUT_POST, 'doc_name', FILTER_SANITIZE_STRING);
        $docDescription = filter_input(INPUT_POST, 'doc_description', FILTER_SANITIZE_STRING);
        
        // Initialize update data array
        $updateData = [
            'doc_name' => $docName,
            'doc_description' => $docDescription
        ];
        
        // Load the document model
        $documentModel = $this->loadModel('documentModel');
        
        // Check if a new file is being uploaded
        if (isset($_FILES['document_file']) && $_FILES['document_file']['error'] === UPLOAD_ERR_OK) {
            // Get the current document to get the old file path
            $document = $documentModel->getDocumentById($documentID)[0] ?? null;
            
            if (!$document) {
                $_SESSION['error'] = "Document not found.";
                header("Location: " . ROOT . "/document/index");
                exit;
            }
            
            // Create a unique filename for the new file
            $fileName = uniqid() . '_' . basename($_FILES['document_file']['name']);
            
            // Define upload folder
            $targetDir = "../public/assets/documents/";
            $targetFile = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            
            // Check file type
            $allowedTypes = ['pdf', 'docx', 'txt'];
            if (!in_array($fileType, $allowedTypes)) {
                $_SESSION['error'] = "Only PDF, DOCX, and TXT files are allowed.";
                header("Location: " . ROOT . "/document/editDocument/" . $documentID);
                exit;
            }
            
            // Move the uploaded file
            if (move_uploaded_file($_FILES['document_file']['tmp_name'], $targetFile)) {
                // Delete the old file if it exists
                $oldFilePath = "../public/assets/documents/" . $document->file_path;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
                
                // Add new file path to update data
                $updateData['file_path'] = $fileName;
            } else {
                $_SESSION['error'] = "Error moving uploaded file.";
                header("Location: " . ROOT . "/document/editDocument/" . $documentID);
                exit;
            }
        }
        
        // Update the document
        $result = $documentModel->update($updateData, $documentID);
        
        if ($result) {
            $_SESSION['success'] = "Document updated successfully!";
            header("Location: " . ROOT . "/document/index");
        } else {
            $_SESSION['error'] = "Failed to update document.";
            header("Location: " . ROOT . "/document/editDocument/" . $documentID);
        }
        exit;
    }
}