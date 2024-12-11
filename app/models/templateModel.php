<?php

    class templateModel{
        use Database;

        protected $table = 'templates';

        public function insert($data) {
            $query = "INSERT INTO {$this->table} 
                  (name,description, document_link)
                  VALUES 
                  (:name, :description, :document_link)";
    
            $params = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                // 'uploaded_by' => $_POST['uploaded_by'],
                'document_link' => $data['document_link']
            ];
            $this->query($query, $params);
        }

        public function getAll() {
            $query = "SELECT * FROM $this->table ORDER BY id DESC";
            return $this->query($query);
        }

        public function findById($id) {
            $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
            $params = ['id' => $id];
            $result = $this->query($query, $params);
            return $result ? $result[0] : null;
        }
    }
?>