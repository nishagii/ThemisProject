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
            'category' => $_POST['category'] ?? '',
            'assigneeID' => $_POST['assigneeID'] ?? '',
            'deadlineDate' => $_POST['deadlineDate'] ?? '',
            'deadlineTime' => $_POST['deadlineTime'] ?? '',
            'priority' => $_POST['priority'] ?? '', 
                 
        ];
       
                

        
        $errors = [];
        if (empty($data['name'])) {
            $errors['name'] = 'Task name is required';
        }
        if (empty($data['description'])) {
            $errors['description'] = 'Description is required';
        }
        if (empty($data['category'])) {
            $errors['category'] = 'Category is required';
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

