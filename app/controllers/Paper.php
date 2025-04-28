<?php 
    
    class Paper {

        use Controller;

        public function index() {

            $paperModel = $this->loadModel('PaperModel');
            $paper = $paperModel->getAll();
            // print_r($paper);

            $this->view('crud/paper',['paper' => $paper]);
        }

        public function addPaper() {

            $this->view('crud/addPaper');
        }

        public function savePaper() {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $data = [
                        'subject' => $_POST['subject']
                        
                ];

                //print_r($data);
            }

            $errors = [];
            if(empty($data['subject'])) {
                $errors['subject'] = 'subject is required';
            }

            if(!empty($errors)) {
                $this->view('crud/addPaper',['data' => $data, 'errors' => $errors]);
                return;
            }

            if (isset($_FILES['paper']) && $_FILES['paper']['error'] === UPLOAD_ERR_OK) {

                $paperName = uniqid(). '_' . basename($_FILES['paper']['name']);
                // var_dump($paperName);

                $targetDir = "../public/assets/paper/";
                // var_dump($targetDir);

                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                    // echo "made";
                }

                $targetFile = $targetDir.$paperName;
                // print_r($targetFile);

                $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                // print_r($fileType);

                $allowedTypes = ['pdf'];
                if(!in_array($fileType, $allowedTypes)) {
                    $errors['paper'] = 'Only pdf is allowed';
                    // echo "only pdf";
                } else {
                    if(!move_uploaded_file($_FILES['paper']['tmp_name'], $targetFile)) {
                        $errors['paper'] = 'error moving file to location';
                    } else {
                        $data['paper'] = $paperName;
                        // echo 'moved';
                    }
                }

                $paperModel = $this->loadModel('PaperModel');
                $paperModel->save($data);
                redirect('Paper');

            } else {
                $errors['paper'] = 'file upload is required';
                $this->view('crud/addPaper',['data' => $data, 'errors' => $errors]);
                return;

            }
        }

        public function deletePaper($paperID) {

            $paperModel = $this->loadModel('PaperModel');
            $paper = $paperModel->getPaperByID($paperID);
            // print_r($paper);

            $result = $paperModel->deletePap($paperID);
            // print_r($result);

            if($result) {
                $filePath = "../public/assets/paper/" . $paper[0]->paper;
                // print_r($filePath);

                if (file_exists($filePath)) {
                    unlink($filePath);
                    echo "done";
                }
            }
            redirect('Paper');
        }
    }