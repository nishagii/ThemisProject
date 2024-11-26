<?php

class Knowledge
{
    use Controller;

    public function index()
    {

        $knowledgeModel = $this->loadModel('knowledgeModel'); 
        $knowledge = $knowledgeModel->getAllKnowledges(); // Fetch cases data

        // Load the view with data
        $this->view('/juniorCounsel/knowledge', ['knowledge' => $knowledge]);
    }



}
