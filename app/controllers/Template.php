<?php


class Template
{
    use Controller;

    private $templateModel;

    public function __construct() {
        $this->templateModel = $this->loadModel('templateModel');
    }

    public function index()
    {

        // Set username from session, or default to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        // Load the view with data
        $this->view('/seniorCounsel/template', $data);
    }
/*------------------------------retrieve function ------------------------------------*/
    public function retrieve()
    {
        $templateModel = $this->loadModel('templateModel'); 
        $templates = $templateModel->getAll();

        // Pass data to the view
        $this->view('seniorCounsel/template', ['templates' => $templates]);
    }
}
