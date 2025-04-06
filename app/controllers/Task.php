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
        $taskModel->completeTask($taskID);

        // Redirect back to the task page
        redirect('task');
    }

}
