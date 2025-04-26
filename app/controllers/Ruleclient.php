<?php

// HomeAdmin class
class RuleClient
{
    use Controller;

    public function index()
    {
        // Set username from session, or default to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $rulesModel = $this->loadModel('SCrulesModel'); 
        $rules = $rulesModel->getAll();

        // Load the view with data
        $this->view('/client/rule', ['rules' => $rules]);
    }
}
