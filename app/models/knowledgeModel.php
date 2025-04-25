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
        $query = "INSERT INTO {$this->table} (topic, note, image ) VALUES (:topic, :note, :image)";
        
        // Prepare the parameters
        $params = [
            'topic' => $data['topic'],
            'note' => $data['note'],
            'image' => $data['image'] ?? null,
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
                return empty($result) ? null : $result[0];
                // Check if result is empty
                if (empty($result)) {
                    return null; // Return null if no case is found
                }
        
                return $result[0]; // Return the first (and expected only) result
            }

            public function updateKnowledge($data)
{
    $query = "UPDATE {$this->table} 
              SET 
                  topic = :topic,
                  note = :note,
                  image = :image
              WHERE id = :id"; // Removed the trailing comma in the SET clause
    
    $params = [
        'topic' => $data['topic'],
        'note' => $data['note'],
        'image' => $data['image'] ?? null,
        'id' => $data['id'], // Ensure the correct key matches the form data
    ];
    
    return $this->query($query, $params);
}

    //delete knowledge
    public function deleteKnowledge($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $params = ['id' => $id];
        return $this->query($query, $params);
    }

    


}