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

        header('Location: ' . ROOT . '/SCrules/create');
        exit;
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
        $SCrulesModel = $this->loadModel('SCrulesModel');
        $rule = $SCrulesModel->getRuleByRuleId($id);

        if (!$rule) {
            die("Rule not found or invalid ID.");
        }
        $this->view('precedentsAdmin/edit_scrule', ['rule' => $rule]);
    }

    public function updateRule() {
        $uploadDir = '../public/assets/scrulesUploads/';
        $allowedTypes = ['application/pdf'];
    
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
    
        function uploadIfExists($fieldName, $uploadDir, $allowedTypes, $currentPathKey) {
            if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] === UPLOAD_ERR_OK) {
                $tmp = $_FILES[$fieldName]['tmp_name'];
                $name = $_FILES[$fieldName]['name'];
                $type = $_FILES[$fieldName]['type'];
                $ext = pathinfo($name, PATHINFO_EXTENSION);
    
                if (!in_array($type, $allowedTypes)) {
                    die("Invalid file type for $fieldName. Please upload a PDF.");
                }
    
                $newName = uniqid($fieldName . '_', true) . '.' . $ext;
                $path = $uploadDir . $newName;
    
                if (move_uploaded_file($tmp, $path)) {
                    return '/themisrepo/public/assets/scrulesUploads/' . $newName;
                } else {
                    die("Failed to upload file for $fieldName.");
                }
            } else {
                return $_POST[$currentPathKey] ?? null;
            }
        }
    
        $data = [
            'id' => $_POST['id'],
            'rule_number' => $_POST['rule_number'],
            'published_date' => $_POST['published_date'],
            'sinhala_link' => uploadIfExists('sinhala_link', $uploadDir, $allowedTypes, 'current_sinhala_link'),
            'tamil_link' => uploadIfExists('tamil_link', $uploadDir, $allowedTypes, 'current_tamil_link'),
            'english_link' => uploadIfExists('english_link', $uploadDir, $allowedTypes, 'current_english_link'),
        ];
    
        $model = $this->loadModel('SCrulesModel');
        $model->update($data);
    
        redirect('SCrules/retrieve');
    }
/*-------------------Delete----------------------------------- */
    public function delete($id)
    {
        // Load the CaseModel
        $caseModel = $this->loadModel('SCrulesModel');

        // Delete the case
        $caseModel->delete($id);

        redirect('SCrules/retrieve');
    }
}