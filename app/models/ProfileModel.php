<?php

class ProfileModel
{
    use Model;
    protected $table = 'users';
    protected $logintable = 'login_logs';

    public function getUserProfile($userId)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $params = ['id' => $userId];
        
        $result = $this->query($query, $params);
        if ($result) {
            return $result[0];
        }
        
        return false;
    }
    
    public function updateProfile($userId, $data)
    {
        $query = "UPDATE {$this->table} SET 
                  first_name = :first_name, 
                  last_name = :last_name, 
                  email = :email, 
                  phone = :phone, 
                  updated_at = NOW()
                  WHERE id = :id";
                  
        $params = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'id' => $userId
        ];
        
        return $this->query($query, $params);
    }
    
    public function updatePassword($userId, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        $query = "UPDATE {$this->table} SET 
                  password = :password,
                  updated_at = NOW()
                  WHERE id = :id";
                  
        $params = [
            'password' => $hashedPassword,
            'id' => $userId
        ];
        
        return $this->query($query, $params);
    }

    public function getLoginDetailsByUserId($userId)
    {
        $query = "SELECT * FROM {$this->logintable} WHERE user_id = :user_id ORDER BY login_time DESC LIMIT 10";
        
        $params = [
            'user_id' => $userId
        ];

        return $this->query($query, $params);
    }
}