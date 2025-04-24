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

    public function getRuleByRuleId($id)
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
    public function getRecentRules(){
        $query = "SELECT * FROM $this->table ORDER BY id DESC LIMIT 3";
        return $this->query($query); 
    }
    
    public function countRules(){
        $query = "SELECT COUNT(*) as total FROM $this->table";
        $result = $this->query($query);
        return $result ? $result[0]->total : 0;
    }
    //update precedents
    public function update($data) {
        $query = "UPDATE {$this->table}
                  SET 
                      rule_number = :rule_number,
                      published_date = :published_date,
                      sinhala_link = :sinhala_link,
                      tamil_link = :tamil_link,
                      english_link = :english_link
                  WHERE id = :id";
    
        $params = [
            ':rule_number' => $data['rule_number'],
            ':published_date' => $data['published_date'],
            ':sinhala_link' => $data['sinhala_link'],
            ':tamil_link' => $data['tamil_link'],
            ':english_link' => $data['english_link'],
            ':id' => $data['id']
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