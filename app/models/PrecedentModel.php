<?php

class PrecedentModel {
    use Database;

    protected $table = 'judgmentsyearwise';

    public function insert($data) {
        $query = "INSERT INTO {$this->table} 
              (judgment_date, case_number, name_of_parties, judgment_by, document_link)
              VALUES 
              (:judgment_date, :case_number, :name_of_parties, :judgment_by, :document_link)";

        $params = [
            'judgment_date' => $_POST['judgment_date'],
            'case_number' => $_POST['case_number'],
            'name_of_parties' => $_POST['parties'],
            'judgment_by' => $_POST['judgment_by'],
            'document_link' => $_POST['document_link']
        ];
        $this->query($query, $params);
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
                    name_of_parties = :name_of_parties,
                    judgment_by = :judgment_by,
                    document_link = :document_link
                    WHERE id = :id";
        $params = [
            'judgment_date' => $data['judgment_date'],
            'case_number' => $data['case_number'],
            'name_of_parties' => $data['name_of_parties'],
            'judgment_by' => $data['judgment_by'],
            'document_link' => $data['document_link'],
            ':id' => $data['id'],
        ];
        return $this->query($query, $params);
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = ?";
        $this->query($query, [$id]);
    }
}