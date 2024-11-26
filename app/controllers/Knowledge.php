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

    //get the case details by id and pass it to the view
    public function editKnowledge($id)
    {

        $knowledgeModel = $this->loadModel('knowledgeModel');

        $knowledge = $knowledgeModel->getKnowledgeById($id);


        // Debugging: Output the $case variable to check its content
        // var_dump($case);
        // die(); // Stop execution after dumping the data to see the output


        if (!$knowledge) {
            die("note not found or invalid ID."); // Handle missing case data
        }

        // Pass the case data to the view
        $this->view('/juniorCounsel/edit_knowledge', ['knowledge' => $knowledge]);
    }

}
