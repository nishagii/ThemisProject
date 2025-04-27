<?php

class Homework {
    use Controller;

    public function index() {

        $homeworkModel = $this->loadModel('HomeworkModel');
        $homework = $homeworkModel->getAll();

        $this->view('crud/homework',['homework' => $homework]);

    }

    public function addHomework() {

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