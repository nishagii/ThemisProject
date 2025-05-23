<?php

class Task
{
    use Controller;

    public function __construct()
    {
       
        $this->requireLogin();
        $this->requireRole(['junior']);
    }

    public function index()
    {
        if (empty($_SESSION['user_id'])) {
            redirect('login');
            return;
        }
    
        $data['username'] = $_SESSION['username'] ?? 'User';
    
        $taskModel = $this->loadModel('TaskModel');
    
        // Get all tasks assigned to the logged-in user
        $userId = $_SESSION['user_id'];
        $allTasks = $taskModel->getTaskByUserId($userId);
        
        // Filter tasks into current (pending/overdue) and completed/incomplete
        $data['tasks'] = [];
        $data['completedTasks'] = [];
        
        foreach ($allTasks as $task) {
            if ($task->status === 'pending' || $task->status === 'overdue') {
                $data['tasks'][] = $task;
            } else {
                // Add completed and incomplete tasks to completedTasks
                $data['completedTasks'][] = $task;
            }
        }
    
        // Load the view and pass the data
        $this->view('/juniorCounsel/task', $data);
    }

    public function complete($taskID)
    {
        if (empty($_SESSION['user_id'])) {
            redirect('login');
            return;
        }
    
        $taskModel = $this->loadModel('TaskModel');
    
        
        $comments = $_POST['comment'] ?? null;
    
        // Mark the task as completed with comments
        if ($taskModel->completeTask($taskID, $comments)) {
            $notificationModel = $this->loadModel('NotificationModel');
            $userModel = $this->loadModel('UserModel');
    
            $task = $taskModel->getTaskById($taskID);
            $lawyers = $userModel->getUsersByRole('lawyer');
    
            foreach ($lawyers as $lawyer) {
                $notification = [
                    'user_id' => $lawyer->id,
                    'message' => "Task '{$task->name}' has been marked as completed. Check out the task board for review",
                    'timestamp' => date('Y-m-d H:i:s'),
                    'status' => 'unread'
                ];
                $notificationModel->createNotification($notification);
            }
        }
    
        redirect('task');
    }
    

    public function details($taskID)
    {
        if (empty($_SESSION['user_id'])) {
            redirect('login');
            return;
        }
        
        // Load the task model
        $taskModel = $this->loadModel('TaskModel');
        
        // Get the task by ID
        $task = $taskModel->getTaskById($taskID);
        
        
        if (!$task) {
            redirect('task');
            return;
        }
        
        // Check if the user has access to this task
        $userId = $_SESSION['user_id'];
        if ($task->assigneeID != $userId) {
            
            redirect('task');
            return;
        }
        
        // Prepare data for the view
        $data = [
            'username' => $_SESSION['username'] ?? 'User',
            'task' => $task
        ];
        
        // Load the task details view
        $this->view('/juniorCounsel/taskDetails', $data);
    }

}
