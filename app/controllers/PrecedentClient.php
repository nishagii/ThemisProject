<?php

// HomeAdmin class
class PrecedentClient
{
    use Controller;

    public function index()
    {

        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
        $caseModel = $this->loadModel('PrecedentModel'); 
        $cases = $caseModel->getAll();

        // Load the view with data
        $this->view('/client/precedent',['cases' => $cases]);
    }
}
