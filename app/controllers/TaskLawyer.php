<?php

class TaskLawyer
{
    use Controller;

    public function index()
    {
        $userModel = $this->loadModel('UserModel'); // Ensure correct model loading
        $users = $userModel->getJuniorsAndAttorneys(); // Fetch juniors and attorneys data

        // Pass data to the view
        $this->view('/seniorCounsel/task', ['users' => $users]);
    }

 
}
