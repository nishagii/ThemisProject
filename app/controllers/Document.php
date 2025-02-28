<?php

class Document
{

    use Controller;

    public function index()
    {
        // Render the "add new case" view with an empty errors array
        $this->view('/seniorCounsel/case_documents');
    }

    // Add a new case
    public function addDocument()
    {
       
    }

    public function retrieveCaseDocuments()
    {
        
    }


    // Delete a document
    public function deleteDocument($documentID)
    {
        
    }

    //display only one document by id
    public function retrieveDocumentByID($documentID)
    {
        
    }

    
    public function editDocument($documentID)
    {

    }

    // Handle  update
    public function updateDocument()
    {
 

        
    }
}
