<?php 
    
    class Paper {

        use Controller;

        public function index() {

            $this->view('crud/addPaper');
        }

        public function savePaper() {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $data = [
                        'subject' => $_POST['subject']
                        
                ];

                // print_r($data);
            }

            $errors = [];
            if(empty($data['subject'])) {
                $errors['subject'] = 'subject is required';
            }

            if(!empty($errors)) {
                $this->view('crud/addPaper',['data' => $data, 'errors' => $errors]);
                return;
            }
        }
    }