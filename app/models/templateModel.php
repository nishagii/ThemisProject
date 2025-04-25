<?php

    class templateModel{
        use Database;

        protected $table = 'templates';

        public function searchCases($query){
            $query = "%$query%";
            $sql = "SELECT * FROM $this->table
                    WHERE name LIKE :query
                    OR description LIKE :query 
                    OR uploaded_by LIKE :query 
                    OR uploaded_date LIKE :query";
    
            return $this->query($sql, ['query' => $query]);
        }

        public function insert($data) {
            $query = "INSERT INTO {$this->table} 
                  (name,description, document_link)
                  VALUES 
                  (:name, :description, :document_link)";
    
            $params = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                // 'uploadeded_by' => $_POST['uploadeded_by'],
                'document_link' => $data['document_link']
            ];
            $this->query($query, $params);
        }

        public function getAll() {
            $query = "SELECT * FROM $this->table ORDER BY id DESC";
            return $this->query($query);
        }

        public function getById($id)
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
        public function getSorted($column){
            $query = "SELECT * FROM $this->table ORDER BY {$column} ASC";
            return $this->query($query);
        }
        
        public function update($data) {
            $query = "UPDATE {$this->table}
                    SET 
                        name = :name,
                        description = :description,
                        document_link = :document_link
                        WHERE id = :id";
            $params = [
                'name' => $data['name'],
                'description' => $data['description'],
                'document_link' => $data['document_link'],
                'id' => $data['id'],
            ];
            return $this->query($query, $params);
        }

        public function delete($id){
            $query = "DELETE FROM $this->table WHERE id = :id";
            $params = ['id' => $id];
            return $this->query($query, $params);
        }
    }
?>