<?php

class TaskLawyer
{
    use Controller;

    public function index()
    {
        $TaskModel = $this->loadModel('TaskModel'); // Ensure correct model loading
        $task = $TaskModel->getAllTasks(); // Fetch cases data

        // Pass data to the view
        $this->view('/seniorCounsel/task', ['task' => $task]);
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

        // Redirect to the list of tasks or a success page
    redirect('tasklawyer');
    }

}
