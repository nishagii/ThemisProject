<?php

// HomeAdmin class
class RuleLawyer
{
    use Controller;

    public function index()
    {
        // Set username from session, or default to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $rulesModel = $this->loadModel('SCrulesModel'); 
        $rules = $rulesModel->getAll();

        $this->view('/seniorCounsel/rule', ['rules' => $rules]);
    }
}
