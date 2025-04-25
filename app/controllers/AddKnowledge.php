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
                'image' => $_POST['image'] ?? '',
            ];
            

                // Validate the data (you can add more validation here as needed)
    $errors = [];
    if (empty($data['topic'])) {
        $errors['topic'] = 'Topic is required';
    }
    if (empty($data['note'])) {
        $errors['note'] = 'note is required';
    }
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/knowledge/";
        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $fileName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $data['image'] = $targetFilePath;
        } else {
            $errors['image'] = 'Failed to upload the image.';
        }
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



