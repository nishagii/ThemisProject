<?php

class TaskModel
{
    use Model; 
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

    // Get a specific case by ID
    public function getTaskById($taskID)
    {
        $query = "SELECT * FROM {$this->table} WHERE taskID = :taskID";
        $params = ['taskID' => $taskID];

        $result = $this->query($query, $params);

        // Check if result is empty
        if (empty($result)) {
            return null; // Return null if no case is found
        }

        return $result[0]; // Return the first (and expected only) result
    }

    public function updateTask($data)
    {
        $query = "UPDATE {$this->table} 
                  SET 
                      name = :name,
                      description = :description,
                      assigneeID = :assigneeID,
                      deadlineDate = :deadlineDate,
                      deadlineTime = :deadlineTime,
                      priority = :priority
                  WHERE taskID = :taskID";
    
        $params = [
            'name' => $data['name'],
            'description' => $data['description'],
            'assigneeID' => $data['assigneeID'],
            'deadlineDate' => $data['deadlineDate'],
            'deadlineTime' => $data['deadlineTime'],
            'priority' => $data['priority'],
            'taskID' => $data['taskID'], // Ensure taskID is passed
        ];
    
        return $this->query($query, $params);
    }
    
    //delete case
    public function deleteTask($taskID)
    {
        $query = "DELETE FROM $this->table WHERE taskID = :taskID";
        $params = ['taskID' => $taskID];
        return $this->query($query, $params);
    }

    public function getTaskByUserId($userId)
    {
        $query = "SELECT taskID, name, description, assigneeID, assignedDate, deadlineDate, deadlineTime, status, priority 
                FROM {$this->table} 
                WHERE assigneeID = :userId";

        $params = ['userId' => $userId];

        return $this->query($query, $params);
    }

    public function completeTask($taskID)
    {
        // Update the task's status to 'completed'
        $query = "UPDATE {$this->table} 
                  SET status = 'completed' 
                  WHERE taskID = :taskID";

        $params = ['taskID' => $taskID];
        return $this->query($query, $params);
    }

    public function getTaskCount() 
    {
        $query = "SELECT COUNT(taskID) AS count FROM {$this->table}";
        return $this->query($query);
    }

}