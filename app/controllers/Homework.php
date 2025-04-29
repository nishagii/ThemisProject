<?php

class Homework {
    use Controller;

    public function index() {

        $homeworkModel = $this->loadModel('HomeworkModel');
        $homework = $homeworkModel->getAll();

        $this->view('crud/homework',['homework' => $homework]);

    }

    public function homeworkForm() {
 // $tags = $_POST['tags'] ?? []; // this is an array
        // $tagsString = implode(',', $tags); // convert to string like "urgent,important"
        // $data['tags'] = $tagsString;
        // $tagsArray = explode(',', $row['tags']);
         // 'tags' => $_POST['tags'] ?? [],  

                
        if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
            $fileName = uniqid() . '_' . basename($_FILES['pdf']['name']);
            $targetDir = "../public/assets/tasks/";

            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $targetFile = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $allowedTypes = ['pdf'];
            if (!in_array($fileType, $allowedTypes)) {
                $errors['pdf'] = 'Only PDF files are allowed.';
            } else {
                if (!move_uploaded_file($_FILES['pdf']['tmp_name'], $targetFile)) {
                    $errors['pdf'] = 'Error moving uploaded file.';
                } else {
                    $data['pdf'] = $fileName; 
                }
            }
        }

        
       
        if (!empty($errors)) {
            $this->view('/addTask/add', ['errors' => $errors, 'data' => $data]);
            return;
        }
        

        $this->view('crud/addHomework');

    }

    public function addHomework() {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'subject' => $_POST['subject'] ?? '',
                'desc' => $_POST['desc'] ?? '',
                'deadlineDate' => $_POST['deadlineDate'] ?? '',
                'deadlineTime' => $_POST['deadlineTime'] ?? '',
                'priority' => $_POST['priority'] ?? '',
            ];

            // print_r($data);

            $errors = [];

            if(empty($data['subject'])) {
                $errors['subject'] = 'subject is required';
            }
            if(empty($data['desc'])) {
                $errors['desc'] = 'description is required';
            }
            if(empty($data['deadlineDate'])) {
                $errors['deadlineDate'] = 'deadline date is required';
            }
            if(empty($data['deadlineTime'])) {
                $errors['deadlineTime'] = 'deadline time is required';
            }
            if(empty($data['priority'])) {
                $errors['priority'] = 'priority is required';
            }

            if(!empty($data['deadlineDate']) && !empty($data['deadlineTime'])) {
                $deadline = strtotime($data['deadlineDate'] . ' ' . $data['deadlineTime']);
                $current = time();
                
                if($deadline <= $current) {
                    $errors['deadline'] = 'Deadline cannot be in the past or current time';
                }
            }

            

            if(!empty($errors)) {
                
                $this->view('crud/addHomework', ['errors' => $errors, 'data' => $data]);
                return;
            }

            $homeworkModel = $this->loadModel('HomeworkModel');
            $homeworkModel->save($data);
            redirect('Homework');
        }
    }

    public function deleteHw($homeworkID) {
        
        $homeworkModel = $this->loadModel('HomeworkModel');
        $homeworkModel->deleteHomework($homeworkID);
        redirect('Homework');
    }

    public function editHomework($homeworkID) {

        $homeworkModel = $this->loadModel('HomeworkModel');
        $homework = $homeworkModel->getHomeworkByID($homeworkID);
        // var_dump($homework);
        $this->view('crud/edit_homework', ['homework' => $homework]);
    }

    public function updateHomework($homeworkID) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                        'homeworkID' => $homeworkID,
                        'subject' => $_POST['subject'] ?? '',
                        'desc' => $_POST['desc'] ?? '',
                        'deadlineDate' => $_POST['deadlineDate'] ?? '',
                        'deadlineTime' => $_POST['deadlineTime'] ?? '',
                        'priority' => $_POST['priority'] ?? '',

                    ];
            
            $errors = [];

            if(empty($data['subject'])) {

                $errors['subject'] = 'subject is required';

            }
            if(empty($data['desc'])) {

                $errors['desc'] = 'description is required';

            }
            if(empty($data['deadlineDate'])) {

                $errors['deadlineDate'] = 'Deadline date is required';

            }
            if(empty($data['deadlineTime'])) {

                $errors['deadlineTime'] = 'Deadline time is required';

            }
            if(empty($data['priority'])) {

                $errors['priority'] = 'priority is required';

            }

            $homeworkModel = $this->loadModel('HomeworkModel');
            $homework = $homeworkModel->getHomeworkByID($homeworkID);
            if(!empty($errors)) {
                // print_r($data);
                // print_r($errors);
                $this->view('crud/edit_homework',['errors' => $errors, 'homework' => $homework]);
                return;
            }

            $homeworkModel->updateHomeworkByID($data);

            redirect('Homework');
            
        }
    }
}