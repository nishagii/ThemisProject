<?php

class Task
{
    use Controller;

    public function index()
    {
        if (empty($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        $data['username'] = $_SESSION['username'] ?? 'User';

        // Load the model
        $taskModel = $this->loadModel('TaskModel');

        // Get tasks assigned to the logged-in user
        $userId = $_SESSION['user_id'];
        $data['tasks'] = $taskModel->getTaskByUserId($userId);

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
        
        // Mark the task as completed
        if ($taskModel->completeTask($taskID)) {
            // Load models using the controller's model loading mechanism
            $notificationModel = $this->loadModel('NotificationModel');
            $userModel = $this->loadModel('UserModel');
            
            // Get task details
            $task = $taskModel->getTaskById($taskID);
            
            // Get lawyers
            $lawyers = $userModel->getUsersByRole('lawyer');
            
            // Create notifications
            foreach ($lawyers as $lawyer) {
                $notification = [
                    'user_id' => $lawyer->id,
                    'message' => "Task '{$task->name}' (ID: $taskID) has been marked as completed.",
                    'timestamp' => date('Y-m-d H:i:s'),
                    'status' => 'unread'
                ];
                $notificationModel->createNotification($notification);
            }
        }
    
        // Redirect back to the task page
        redirect('task');
    }

}
