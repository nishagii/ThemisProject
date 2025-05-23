<?php

class TaskLawyer
{
    use Controller;

    public function __construct()
    {
       
        $this->requireLogin();
        $this->requireRole(['lawyer']);
    }

    public function index()
    {
        $TaskModel = $this->loadModel('TaskModel'); 

        $task = $TaskModel->getAllTasks();
        $pendingCount = $TaskModel->getTaskCountByStatus('pending');
        $completedCount = $TaskModel->getTaskCountByStatus('completed');
        $overdueCount = $TaskModel->getTaskCountByStatus('overdue');

        
        $totalCount = ($pendingCount[0]->count ?? 0) + 
                    ($completedCount[0]->count ?? 0) + 
                    ($overdueCount[0]->count ?? 0);

        $this->view('/seniorCounsel/task', [
            'task' => $task,
            'totalCount' => $totalCount,
            'pendingCount' => $pendingCount,
            'completedCount' => $completedCount,
            'overdueCount' => $overdueCount
        ]);
    }



    //get the case details by id and pass it to the view
    public function editTask($taskID)
    {

        $userModel = $this->loadModel('UserModel');
        $users = $userModel->getJuniorsAndAttorneys();
        $taskModel = $this->loadModel('taskModel');

        $task = $taskModel->getTaskById($taskID);


        // Debugging: Output the $case variable to check its content
        // var_dump($case);
        // die(); // Stop execution after dumping the data to see the output


        if (!$task) {
            die("Task not found or invalid ID."); // Handle missing case data
        }

        // Pass the case data to the view
        $this->view('/seniorCounsel/edit_task', ['task' => $task, 'users' => $users]);
    }

    public function updateTask()
{
    // Collect POST data
    $data = [
        'taskID' => $_POST['taskID'] ?? '', // Include taskID
        'name' => $_POST['name'] ?? '',
        'description' => $_POST['description'] ?? '',
        'assigneeID' => $_POST['assigneeID'] ?? '',
        'deadlineDate' => $_POST['deadlineDate'] ?? '',
        'deadlineTime' => $_POST['deadlineTime'] ?? '',
        'priority' => $_POST['priority'] ?? '',
    ];

    // Load the Task model
    $taskModel = $this->loadModel('TaskModel');

    // Call the update method from the model
    $taskModel->updateTask($data);

    // Redirect to the list of tasks or a success page
    redirect('tasklawyer');
}

    // Delete a case
    public function deleteTask($taskID)
    {
        // Load the CaseModel
        $taskModel = $this->loadModel('TaskModel');

        // Delete the case
        $taskModel->deleteTask($taskID);

        
    redirect('tasklawyer');
    }

    public function overdueTask($taskID)
    {
        // Load the TaskModel
        $taskModel = $this->loadModel('TaskModel');

        // Update the task status to "overdue"
        $taskModel->updateTaskStatus($taskID, 'overdue');

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => "Task $taskID marked as overdue"]);
    }

        // Display task details
    public function details($taskID)
    {
        // Load the Task model
        $taskModel = $this->loadModel('TaskModel');
        
        // Get the task by ID
        $task = $taskModel->getTaskById($taskID);
        
        // Check if task exists
        if (!$task) {
            die("Task not found or invalid ID.");
        }
        
        
        // Pass the task data to the view
        $this->view('/seniorCounsel/task_details', [
            'task' => $task
        ]);
    }

}
