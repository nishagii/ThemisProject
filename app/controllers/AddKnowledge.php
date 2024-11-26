<?php

class AddKnowledge
{
    use Controller;

    public function index()
    {
         $userModel = $this->loadModel('UserModel');

        // Render the "add new case" view and pass the users' data
        $this->view('/juniorCounsel/addKnowledge', ['users' => $users]);
    }

    public function add() {   
        // Collect POST data
        $data = [
            'topic' => $_POST['topic'] ?? '',
            'note' => $_POST['note'] ?? '',
        ];
    
        // Save data to the database
        $knowledgeModel = $this->loadModel('knowledgeModel');
        $knowledgeModel->save($data);
    
        // Redirect to the knowledge page
        redirect('knowledge');
    }
    

}
