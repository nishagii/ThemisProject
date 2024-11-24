<?php

class PrecedentsController {
    use Controller;

    private $precedentModel;

    public function __construct() {
        $this->precedentModel = $this->loadModel('PrecedentModel');
    }

    public function index() {
        $precedents = $this->precedentModel->getAll();
        $this->view('precedents/precedents_yearwise', [
            'precedents' => $precedents
        ]);
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'date' => $_POST['date'],
                'case_number' => $_POST['case_number'],
                'parties' => $_POST['parties'],
                'judgment_by' => $_POST['judgment_by'],
                'document_link' => $_POST['document_link']
            ];
            
            $this->precedentModel->insert($data);
            header("Location: " . ROOT . "/precedents");
        }
        
        $this->view('precedents/create');
    }

    public function edit($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'date' => $_POST['date'],
                'case_number' => $_POST['case_number'],
                'parties' => $_POST['parties'],
                'judgment_by' => $_POST['judgment_by'],
                'document_link' => $_POST['document_link']
            ];
            
            $this->precedentModel->update($id, $data);
            header("Location: " . ROOT . "/precedents");
        }
        
        $precedent = $this->precedentModel->getById($id);
        $this->view('precedents/edit', [
            'precedent' => $precedent
        ]);
    }

    public function delete($id) {
        $this->precedentModel->delete($id);
        header("Location: " . ROOT . "/precedents");
    }
}