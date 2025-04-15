<?php

class LoginModel 
{
    use Model; // Assumes the Model trait handles database queries
    protected $table = 'login_logs'; // Name of the database table

    // Save login details into the login_logs table
    public function save($data)
    {
        // Prepare the query to insert data into the "login_logs" table
        $query = "INSERT INTO {$this->table} 
                  (user_id, login_time, ip_address, status)
                  VALUES 
                  (:user_id, NOW(), :ip_address, :status)";

        // Bind parameters to prevent SQL injection
        $params = [
            'user_id'    => $data['user_id'],
            'ip_address' => $data['ip_address'],
            'status'     => $data['status'],
        ];

        // Execute the query using the parent Model class's query method
        return $this->query($query, $params);
    }
}
