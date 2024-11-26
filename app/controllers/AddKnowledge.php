<?php

class AddKnowledge
{
    use Controller;

    // This method handles displaying the form
    public function index()
    {

    
        $this->view('/juniorCounsel/addKnowledge');
    }

    // This method handles the form submission
    public function add() {   
            $data = [
                'topic' => $_POST['topic'] ?? '',
                'note' => $_POST['note'] ?? '',
            ];

                // Validate the data (you can add more validation here as needed)
    $errors = [];
    if (empty($data['topic'])) {
        $errors['topic'] = 'Topic is required';
    }
    if (empty($data['note'])) {
        $errors['note'] = 'note is required';
    }

    // If there are errors, render the form again with error messages
    if (!empty($errors)) {
        // Pass errors to the view and render the form again
        $this->view('/addKnowledge/add', ['errors' => $errors, 'data' => $data]);
        return;
    }

            // Save data to the database
            $knowledgeModel = $this->loadModel('knowledgeModel');
            $knowledgeModel->save($data);

            // Redirect to the knowledge page after successful insertion
            redirect('knowledge');
        }
    }



