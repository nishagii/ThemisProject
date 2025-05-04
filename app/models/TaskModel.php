<?php

class TaskModel
{
    use Model; 
    protected $table = 'task'; 

    /**
     * Save a new task to the database.
     *
     * @param array $data Associative array containing task details.
     * @return bool True if the operation was successful, false otherwise.
     */
    public function save($data)
    {
     
        $query = "INSERT INTO {$this->table} 
                (name, description, category, task_doc, assigneeID, assignedDate, deadlineDate, deadlineTime, status, priority)
                VALUES 
                (:name, :description, :category, :task_doc, :assigneeID, NOW(), :deadlineDate, :deadlineTime, 'pending', :priority)";

       
        $params = [
            'name' => $data['name'],
            'description' => $data['description'],
            'category' => $data['category'],
            'task_doc' => isset($data['pdf']) ? $data['pdf'] : null, 
            'assigneeID' => $data['assigneeID'],
            'deadlineDate' => $data['deadlineDate'],
            'deadlineTime' => $data['deadlineTime'],
            'priority' => $data['priority'],
        ];

      
        return $this->query($query, $params);
    }

    public function getAllTasks()
    {
        
        $query = "SELECT t.taskID, t.name, t.description,t.category, t.assigneeID, u.username AS assigneeName, 
                        t.assignedDate, t.deadlineDate, t.deadlineTime, t.status, t.priority 
                FROM {$this->table} t
                INNER JOIN users u ON t.assigneeID = u.id
                ORDER BY t.taskID DESC";

   
        return $this->query($query);
    }


    public function getTaskById($taskID)
    {
        $query = "SELECT t.*, users.username as assigneeName FROM {$this->table} t inner join users on t.assigneeID = users.id WHERE taskID = :taskID";
        $params = ['taskID' => $taskID];

        $result = $this->query($query, $params);

     
        if (empty($result)) {
            return null; 
        }

        return $result[0]; 
    }

    public function updateTask($data)
    {
        $query = "UPDATE {$this->table} 
                  SET 
                      name = :name,
                      description = :description,
                      category = :category,
                      assigneeID = :assigneeID,
                      deadlineDate = :deadlineDate,
                      deadlineTime = :deadlineTime,
                      priority = :priority
                  WHERE taskID = :taskID";
    
        $params = [
            'name' => $data['name'],
            'description' => $data['description'],
            'category' => $data['category'],
            'assigneeID' => $data['assigneeID'],
            'deadlineDate' => $data['deadlineDate'],
            'deadlineTime' => $data['deadlineTime'],
            'priority' => $data['priority'],
            'taskID' => $data['taskID'], 
        ];
    
        return $this->query($query, $params);
    }
    
 
    public function deleteTask($taskID)
    {
        $query = "DELETE FROM $this->table WHERE taskID = :taskID";
        $params = ['taskID' => $taskID];
        return $this->query($query, $params);
    }

    public function getTaskByUserId($userId)
    {
        $query = "SELECT taskID, name, description,category, assigneeID, assignedDate, deadlineDate, deadlineTime, status, priority 
                FROM {$this->table} 
                WHERE assigneeID = :userId ORDER BY taskID DESC";

        $params = ['userId' => $userId];

        return $this->query($query, $params);
    }

    public function completeTask($taskID, $comment = null)
    {
        $query = "UPDATE {$this->table} 
                  SET status = 'completed',
                      comment = :comment,
                      completionDate = NOW()
                  WHERE taskID = :taskID";
    
        $params = [
            'taskID' => $taskID,
            'comment' => $comment
        ];
    
        return $this->query($query, $params);
    }

    
    

    public function getTaskCountByStatus($status) 
    {
        $query = "SELECT COUNT(taskID) AS count FROM {$this->table} WHERE status = :status";
        return $this->query($query, ['status' => $status]);
    }

    public function getTaskCountHighAndActive() 
    {
        $query = "SELECT COUNT(taskID) AS highAndActive FROM task WHERE priority = 'high' AND status = 'pending'";
        return $this->query($query);
    }
    

    public function updateTaskStatus($taskID, $status)
    {
        $query = "UPDATE {$this->table} 
                SET status = :status 
                WHERE taskID = :taskID";

        $params = [
            'status' => $status,
            'taskID' => $taskID
        ];

        return $this->query($query, $params);
    }


}