<?php

class TaskModel
{
    use Model; // Assuming you're using a Model trait for database interaction.
    protected $table = 'task'; // Name of the database table for tasks

    /**
     * Save a new task to the database.
     *
     * @param array $data Associative array containing task details.
     * @return bool True if the operation was successful, false otherwise.
     */
    public function save($data)
    {
        // Prepare the query to insert data into the "tasks" table
        $query = "INSERT INTO {$this->table} 
                  (name, description, assigneeID,assignedDate, deadlineDate, deadlineTime,status, priority)
                  VALUES 
                  (:name, :description, :assigneeID, NOW(), :deadlineDate, :deadlineTime,'pending', :priority)";

        // Bind parameters to prevent SQL injection
        $params = [
            'name' => $data['name'],
            'description' => $data['description'],
            'assigneeID' => $data['assigneeID'],
            'deadlineDate' => $data['deadlineDate'],
            'deadlineTime' => $data['deadlineTime'],
            'priority' => $data['priority'],
        ];

        // Execute the query using the parent Model class's query method
        return $this->query($query, $params);
    }

    public function getAllTasks()
    {
        // Prepare the SQL query to fetch all tasks
        $query = "SELECT taskID, name, description, assigneeID, assignedDate, deadlineDate, deadlineTime, status, priority 
                  FROM {$this->table}";

        // Execute the query and return the results
        return $this->query($query);
    }
}
