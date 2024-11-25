<?php

class AddTask
{

    use Controller;

    public function index()
    {
        // Render the "add new case" view with an empty errors array
        $this->view('/seniorCounsel/addTask');
    }

}