<?php

class AddKnowledge
{
    use Controller;

    // This method handles displaying the form
    public function index()
    {

        // Render the "add new knowledge" view and pass users' data if needed
        $this->view('/juniorCounsel/addKnowledge');
    }

    // This method handles the form submission
    public function add() {   
        // Check if the form is submitted via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Collect POST data
            $data = [
                'topic' => $_POST['topic'] ?? '',
                'note' => $_POST['note'] ?? '',
            ];

            // Validate the data (optional, depending on your requirements)
            if (empty($data['topic']) || empty($data['note'])) {
                $errors = ['Both topic and note are required.'];
                // Pass errors to the view and render the form again
                $this->view('/juniorCounsel/addKnowledge', ['errors' => $errors, 'data' => $data]);
                return;
            }

            // Save data to the database
            $knowledgeModel = $this->loadModel('knowledgeModel');
            $knowledgeModel->save($data);

            // Redirect to the knowledge page after successful insertion
            redirect('knowledge');
        }
    }
}
