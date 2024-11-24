<?php

class PrecedentModel {
    use Database;

    protected $table = 'precedents';

    public function insert($data) {
        $keys = array_keys($data);
        $columns = implode(',', $keys);
        $values = implode(',', array_fill(0, count($keys), '?'));
        
        $query = "INSERT INTO $this->table ($columns) VALUES ($values)";
        
        $this->query($query, array_values($data));
    }

    public function getAll() {
        $query = "SELECT * FROM $this->table ORDER BY date DESC";
        return $this->query($query);
    }

    public function getById($id) {
        $query = "SELECT * FROM $this->table WHERE id = ?";
        return $this->get_row($query, [$id]);
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