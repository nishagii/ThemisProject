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

 
}
