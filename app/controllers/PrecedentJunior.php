<?php


class PrecedentJunior
{
    use Controller;

    public function index()
    {

        // Set username from session, or default to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
        $caseModel = $this->loadModel('PrecedentModel'); 
        $cases = $caseModel->getAll();

  

        // Load the view with data
        $this->view('/juniorCounsel/precedent',['cases' => $cases] );
    }
}
