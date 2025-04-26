<?php


class TemplateClient
{
    use Controller;

    public function index()
    {

        // Set username from session, or default to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $templateModel = $this->loadModel('templateModel'); 
        $templates = $templateModel->getAll();

        $this->view('/client/template', ['templates' => $templates]);
    }
}
