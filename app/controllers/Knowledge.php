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


    public function updateKnowledge()
{
    // Collect POST data
    $data = [
        'id' => $_POST['id'] ?? '', // Include taskID
        'topic' => $_POST['topic'] ?? '',
        'note' => $_POST['note'] ?? '',
    ];
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/knowledge/";
        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $fileName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $data['image'] = $targetFilePath;
        }
    }


    // Load the Task model
    $knowledgeModel = $this->loadModel('knowledgeModel');

    // Call the update method from the model
    $knowledgeModel->updateKnowledge($data);

    // Redirect to the list of tasks or a success page
    redirect('knowledge');
}
    // Delete a case
    public function deleteKnowledge($id)
    {
        // Load the CaseModel
        $knowledgeModel = $this->loadModel('knowledgeModel');

        // Delete the case
        $knowledgeModel->deleteKnowledge($id);

        // Redirect to the list of tasks or a success page
    redirect('knowledge');
    }

}
