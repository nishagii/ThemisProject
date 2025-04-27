<?php

class Knowledge
{
    use Controller;

    public function index()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        $knowledgeModel = $this->loadModel('knowledgeModel');
        $knowledge = $knowledgeModel->getAllKnowledges(); // Fetch knowledge data
        
        // Load the view with data
        $this->view('/juniorCounsel/knowledge', ['knowledge' => $knowledge]);
    }

    // Get the knowledge details by id and pass it to the view
    public function editKnowledge($id)
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        $knowledgeModel = $this->loadModel('knowledgeModel');
        $knowledge = $knowledgeModel->getKnowledgeById($id);
        
        if (!$knowledge) {
            $_SESSION['error_message'] = "Note not found or invalid ID.";
            redirect('knowledge');
            return;
        }
        
        // Pass the knowledge data to the view
        $this->view('/juniorCounsel/edit_knowledge', ['knowledge' => $knowledge]);
    }

    public function updateKnowledge()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        // Collect POST data
        $data = [
            'id' => $_POST['id'] ?? '',
            'topic' => $_POST['topic'] ?? '',
            'note' => $_POST['note'] ?? '',
        ];

        // Validate input
        $errors = [];
        if (empty($data['topic'])) {
            $errors['topic'] = 'Topic is required';
        }
        if (empty($data['note'])) {
            $errors['note'] = 'Note is required';
        }

        // If there are errors, redirect back with errors
        if (!empty($errors)) {
            $knowledgeModel = $this->loadModel('knowledgeModel');
            $knowledge = $knowledgeModel->getKnowledgeById($data['id']);
            
            $this->view('/juniorCounsel/edit_knowledge', [
                'errors' => $errors,
                'knowledge' => $knowledge
            ]);
            return;
        }

        // Get the current knowledge to preserve image if no new one is uploaded
        $knowledgeModel = $this->loadModel('knowledgeModel');
        $currentKnowledge = $knowledgeModel->getKnowledgeById($data['id']);
        
        // Default to current image
        $data['image'] = $currentKnowledge->image ?? null;

        // Handle file upload if a file was provided
        if (!empty($_FILES['image']['name'])) {
            // Create upload directory if it doesn't exist
            $targetDir = "uploads/knowledge/";
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true); // Create directory with all permissions
            }
            
            $fileName = basename($_FILES['image']['name']);
            $targetFilePath = $targetDir . $fileName;
            
            // Check if file already exists and rename if necessary
            $fileCounter = 1;
            $fileInfo = pathinfo($fileName);
            $baseName = $fileInfo['filename'];
            $extension = isset($fileInfo['extension']) ? '.' . $fileInfo['extension'] : '';
            
            while (file_exists($targetFilePath)) {
                $newFileName = $baseName . '(' . $fileCounter . ')' . $extension;
                $targetFilePath = $targetDir . $newFileName;
                $fileCounter++;
            }
            
            // Move the file to the uploads directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $data['image'] = $targetFilePath;
            } else {
                $_SESSION['error_message'] = 'Failed to upload image. Knowledge updated without new image.';
            }
        }

        // Call the update method from the model
        $result = $knowledgeModel->updateKnowledge($data);
        
        if ($result) {
            $_SESSION['success_message'] = 'Knowledge updated successfully';
        } else {
            $_SESSION['error_message'] = 'Failed to update knowledge';
        }

        // Redirect to the list of knowledge
        redirect('knowledge');
    }

    // Delete a knowledge note
    public function deleteKnowledge($id)
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        // Load the KnowledgeModel
        $knowledgeModel = $this->loadModel('knowledgeModel');
        
        // Get the knowledge to delete (to handle image deletion if needed)
        $knowledge = $knowledgeModel->getKnowledgeById($id);
        
        if (!$knowledge) {
            $_SESSION['error_message'] = "Note not found or invalid ID.";
            redirect('knowledge');
            return;
        }
        
        // Delete the knowledge
        $result = $knowledgeModel->deleteKnowledge($id);
        
        if ($result) {
            // Optionally delete the associated image file
            if (!empty($knowledge->image) && file_exists($knowledge->image)) {
                unlink($knowledge->image);
            }
            
            $_SESSION['success_message'] = 'Knowledge deleted successfully';
        } else {
            $_SESSION['error_message'] = 'Failed to delete knowledge';
        }
        
        // Redirect to the list of knowledge
        redirect('knowledge');
    }
}
