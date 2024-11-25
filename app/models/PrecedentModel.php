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

    public function getYearwise() {
        $query = "SELECT * FROM {$this->table} WHERE YEAR(judgment_date) = ? ORDER BY judgment_date DESC";

        $stmt = $this->connect()->prepare($query);  // Use the `connect()` method from the Database trait for connection
        $stmt->bind_param("i", $year);
        $stmt->execute();

        $result = $stmt->get_result();

        $cases = [];
        while ($row = $result->fetch_assoc()) {
            $cases[] = $row;
        }
        return $cases;
    }

    public function getAll() {
        $query = "SELECT * FROM $this->table ORDER BY id DESC";
        return $this->query($query);
    }

    public function update($id, $data) {
        $sets = [];
        foreach($data as $key => $value) {
            $sets[] = "$key = ?";
        }
        $setString = implode(',', $sets);
        
        $query = "UPDATE $this->table SET $setString WHERE id = ?";
        
        $values = array_values($data);
        $values[] = $id;
        
        $this->query($query, $values);
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = ?";
        $this->query($query, [$id]);
    }
}