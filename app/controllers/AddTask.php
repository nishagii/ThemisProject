<?php

class AddTask
{
    use Controller;

    public function index()
    {
        $userModel = $this->loadModel('UserModel');
        $users = $userModel->getJuniorsAndAttorneys();

        $this->view('/seniorCounsel/addTask', ['users' => $users]);
    }

    // Add a new task with optional PDF file upload
    public function add()
    {
        // Collect POST data for the task
        $data = [
            'name' => $_POST['name'] ?? '',
            'description' => $_POST['description'] ?? '',
            'assigneeID' => $_POST['assigneeID'] ?? '',
            'deadlineDate' => $_POST['deadlineDate'] ?? '',
            'deadlineTime' => $_POST['deadlineTime'] ?? '',
            'priority' => $_POST['priority'] ?? '',
        ];

        // Validate the data (you can add more validation here as needed)
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

        // If there are errors, render the form again with error messages
        if (!empty($errors)) {
            // Pass errors to the view and render the form again
            $this->view('/addTask/add', ['errors' => $errors, 'data' => $data]);
            return;
        }

        // Handle PDF file upload (optional)
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
                    $data['pdf'] = $fileName; // Store the PDF file name to save later in DB
                }
            }
        }

        // If there are any errors, re-render the form with the errors
        if (!empty($errors)) {
            $this->view('/addTask/add', ['errors' => $errors, 'data' => $data]);
            return;
        }

        // Save the task data
        $taskModel = $this->loadModel('TaskModel');
        $taskModel->save($data);

        // After the task is created, send notification to the assignee
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

        // Redirect to the task list or success page
        redirect('tasklawyer');
    }
}
