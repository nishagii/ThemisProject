<?php

class knowledgeModel
{

    
    use Model;
    protected $table = 'knowledge'; // Name of the database table

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
    
    


}