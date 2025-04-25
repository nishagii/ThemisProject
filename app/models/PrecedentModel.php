<?php

class PrecedentModel {
    use Database;

    protected $table = 'judgmentsyearwise';

    public function searchCases($query){
        $query = "%$query%";
        $sql = "SELECT * FROM $this->table
                WHERE case_number LIKE :query
                OR judgment_date LIKE :query 
                OR description LIKE :query 
                OR judgment_by LIKE :query";

        return $this->query($sql, ['query' => $query]);
    }

    public function insert($data) {
        $query = "INSERT INTO {$this->table} 
              (judgment_date, case_number, description, judgment_by, document_link)
              VALUES 
              (:judgment_date, :case_number, :description, :judgment_by, :document_link)";

        $params = [
            'judgment_date' => $_POST['judgment_date'],
            'case_number' => $_POST['case_number'],
            'description' => $_POST['description'],
            'judgment_by' => $_POST['judgment_by'],
            'document_link' => $data['document_link']
        ];
        $this->query($query, $params);
    }

    public function getSorted($column){
        $query = "SELECT * FROM $this->table ORDER BY {$column} ASC";
        return $this->query($query);
    }

    public function getAll() {
        $query = "SELECT * FROM $this->table ORDER BY id DESC";
        return $this->query($query);
    }

    public function getByCaseId($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $params = ['id' => $id];

        $result = $this->query($query, $params);

        // Check if result is empty
        if (empty($result)) {
            return null;
        }
        return $result[0];
    }

    public function getRecentCases(){
        $query = "SELECT * FROM $this->table ORDER BY id DESC LIMIT 3";
        return $this->query($query); 
    }
    
    public function countPrecedents(){
        $query = "SELECT COUNT(*) as total FROM $this->table";
        $result = $this->query($query);
        return $result ? $result[0]->total : 0;
    }

    //update precedents
    public function update($data) {
        $query = "UPDATE {$this->table}
                SET 
                    judgment_date = :judgment_date,
                    case_number = :case_number,
                    description = :description,
                    judgment_by = :judgment_by,
                    document_link = :document_link
                    WHERE id = :id";
        $params = [
            'judgment_date' => $data['judgment_date'],
            'case_number' => $data['case_number'],
            'description' => $data['description'],
            'judgment_by' => $data['judgment_by'],
            'document_link' => $data['document_link'],
            ':id' => $data['id'],
        ];
        return $this->query($query, $params);
    }

    //delete precedents
    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $params = ['id' => $id];
        return $this->query($query, $params);
    }
}