<?php

class AddTask
{
    use Controller;

    public function __construct()
    {
       
        $this->requireLogin();
        $this->requireRole(['lawyer']);
    }

    public function index()
    {
        $userModel = $this->loadModel('UserModel');
        $users = $userModel->getJuniorsAndAttorneys();

        $this->view('/seniorCounsel/addTask', ['users' => $users]);
    }

    
    public function add()
    {
        
        $data = [
            'name' => $_POST['name'] ?? '',
            'description' => $_POST['description'] ?? '',
            'assigneeID' => $_POST['assigneeID'] ?? '',
            'deadlineDate' => $_POST['deadlineDate'] ?? '',
            'deadlineTime' => $_POST['deadlineTime'] ?? '',
            'priority' => $_POST['priority'] ?? '',
            'tags' => $_POST['tags'] ?? [],

        ];

        $data = [
            'name' => $_POST['name'] ?? '',
            'description' => $_POST['description'] ?? '',
            'assigneeID' => $_POST['assigneeID'] ?? '',
            'deadlineDate' => $_POST['deadlineDate'] ?? '',
            'deadlineTime' => $_POST['deadlineTime'] ?? '',
            'priority' => $_POST['priority'] ?? '', // from radio buttons
            // 'tags' => $_POST['tags'] ?? [],          // from checkboxes
        ];
        // $tags = $_POST['tags'] ?? []; // this is an array
        // $tagsString = implode(',', $tags); // convert to string like "urgent,important"
        // $data['tags'] = $tagsString;
        // $tagsArray = explode(',', $row['tags']);
                

        
        $errors = [];
        if (empty($data['name'])) {
            $errors['name'] = 'Task name is required';
        }
        if (empty($data['description'])) {
            $errors['description'] = 'Description is required';
        }
        if (empty($data['assigneeID'])) {
            $errors['assigneeID'] = 'Assignee is required';
        }
        if (empty($data['deadlineDate'])) {
            $errors['deadlineDate'] = 'Deadline date is required';
        }
        if (empty($data['deadlineTime'])) {
            $errors['deadlineTime'] = 'Deadline time is required';
        }
        if (empty($data['priority'])) {
            $errors['priority'] = 'Priority is required';
        }

       
        if (!empty($errors)) {
           
            $this->view('/addTask/add', ['errors' => $errors, 'data' => $data]);
            return;
        }

       
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

      
        $taskModel = $this->loadModel('TaskModel');
        $taskModel->save($data);

       
        $notificationModel = $this->loadModel('NotificationModel');
        $task = $data['id'];
        $name = $data['name'];
        $assignee = $data['assigneeID'];

        $notification = [
            'user_id' => $assignee,
            'message' => "Task '$name' has been assigned to you. Check your task board",
            'timestamp' => date('Y-m-d H:i:s'),
            'status' => 'unread'
        ];
        $notificationModel->createNotification($notification);

       
        redirect('tasklawyer');
    }
}

