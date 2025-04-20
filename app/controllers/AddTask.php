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

    // Add a new task
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

        $taskModel = $this->loadModel('TaskModel');
        $taskModel->save($data);

        //after the task is created send notification the assignee
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
