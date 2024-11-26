<?php

class knowledgeModel
{

    
    use Model;
    protected $table = 'knowledge'; 

    /**
     * Save a new case to the database.
     *
     * @param array $data Associative array containing case details.
     * @return bool True if the operation was successful, false otherwise.
     */
    public function save($data) {
        $query = "INSERT INTO {$this->table} (topic, note) VALUES (:topic, :note)";
        
        // Prepare the parameters
        $params = [
            'topic' => $data['topic'],
            'note' => $data['note'],
        ];
        
        // Execute the query and check for success
        return $this->query($query, $params);
    }

    // Retrieve all knowledge
    public function getAllKnowledges()
    {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }


            // Get a specific case by ID
            public function getKnowledgeById($id)
            {
                $query = "SELECT * FROM {$this->table} WHERE id = :id";
                $params = ['id' => $id];
        
                $result = $this->query($query, $params);
        
                // Check if result is empty
                if (empty($result)) {
                    return null; // Return null if no case is found
                }
        
                return $result[0]; // Return the first (and expected only) result
            }

    //delete knowledge
    public function deleteKnowledge($knowledgeId)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $params = ['id' => $knowledgeId];
        return $this->query($query, $params);
    }

    


}