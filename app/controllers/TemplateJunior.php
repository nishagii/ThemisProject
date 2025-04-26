<?php


class TemplateJunior
{
    use Controller;

    public function index()
    {

        // Set username from session, or default to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
        
        $templateModel = $this->loadModel('templateModel'); 
        $templates = $templateModel->getAll();

        // Load the view with data
        $this->view('/juniorCounsel/template', ['templates' => $templates]);
    }
}
