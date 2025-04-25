<?php

// HomeAdmin class
class RuleJunior
{
    use Controller;

    public function index()
    {
        // Set username from session, or default to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $rulesModel = $this->loadModel('SCrulesModel');
        $rules = $rulesModel->getAll();

        // Load the view with data
        $this->view('/juniorcounsel/rule',['rules' => $rules]);
    }
}
