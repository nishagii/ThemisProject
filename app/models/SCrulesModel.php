<?php

class SCrulesModel {
    use Database;

    protected $table = 'sc_rules';

    public function insert($data) {
        $query = "INSERT INTO {$this->table} 
              (rule_number,published_date,sinhala_link,tamil_link,english_link)
              VALUES 
              (:rule_number, :published_date,:sinhala_link,:tamil_link,:english_link)";

        $params = [
            'rule_number' => $_POST['rule_number'],
            'published_date' => $_POST['published_date'],
            'sinhala_link' => $data['sinhala_link'],
            'tamil_link' => $data['tamil_link'],
            'english_link' => $data['english_link']
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