<?php

class PrecedentsController {
    use Controller;

    private $precedentModel;

    public function __construct() {
        $this->precedentModel = $this->loadModel('PrecedentModel');
    }

    public function index()
    {
        $this->view('create_precedent');
    }
/*---------------------Create operation----------------------------- */
    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'judgment_date' => $_POST['judgment_date'],
                'case_number' => $_POST['case_number'],
                'parties' => $_POST['parties'],
                'judgment_by' => $_POST['judgment_by'],
                'document_link' => $_POST['document_link']
            ];
            
            $this->precedentModel->insert($data);
            header("Location: " . ROOT . "/precedents/index");
        }
        
        $this->view('create_precedent');
    }
    public function retrieveYearwise()
    {
        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');
        
        $caseModel = $this->loadModel('PrecedentModel'); // Ensure correct model loading
        $cases = $caseModel->getYearwise($year);
        // Pass data to the view
        $this->view('/precedents_yearwise', ['cases' => $cases, 'year' => $year]);
    }

    public function retrieveAll() {
        $caseModel = $this->loadModel('PrecedentModel'); // Ensure correct model loading
        $cases = $caseModel->getAll(); // Fetch cases data

        // Pass data to the view
        $this->view('/all_precedents', ['cases' => $cases]);
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