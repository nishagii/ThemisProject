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
    public function save($data)
    {
        // Prepare the query to insert data into the "cases" table
        $query = "INSERT INTO {$this->table} 
                  (topic, note) 
                  VALUES 
                  (:topic, :note)";  // Fixed missing closing parenthesis and quotation mark
    
        // Bind parameters to prevent SQL injection
        $params = [
            'topic' => $data['topic'],
            'note' => $data['note'],
        ];
    
        // Execute the query using the parent Model class's query method
        return $this->query($query, $params);
    }
    


}