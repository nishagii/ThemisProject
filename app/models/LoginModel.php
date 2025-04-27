<?php

class LoginModel 
{
    use Model; 
    protected $table = 'login_logs'; 

    
    public function save($data)
    {
       
        $query = "INSERT INTO {$this->table} 
                  (user_id, attempted_username, login_time, ip_address, status)
                  VALUES 
                  (:user_id, :attempted_username, NOW(), :ip_address, :status)";

        
        $params = [
            'user_id'    => $data['user_id'],
            'attempted_username'    => $data['attempted_username'],
            'ip_address' => $data['ip_address'],
            'status'     => $data['status'],
        ];

        
        return $this->query($query, $params);
    }

    
    public function getLoginDetailsByUserId($userId)
    {
       
        $query = "SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY login_time DESC";

        
        $params = [
            'user_id' => $userId
        ];

    
        return $this->query($query, $params);
    }

    public function getAllLoginDetails() {
        $query = "SELECT * FROM {$this->table} ORDER BY login_time DESC";
        return $this->query($query);
    }
}
