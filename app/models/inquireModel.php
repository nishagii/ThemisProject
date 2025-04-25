<?php

class InquireModel 
{
    use Model;
    protected $table = 'inquiries'; // Name of the database table
    public function save($data)
    {
        // $query = "INSERT INTO inquiries (name, email, message, created_at) 
        //           VALUES (:name, :email, :message, NOW())";
        // $data = [
        //     'name' => $name,
        //     'email' => $email,
        //     'message' => $message,
        // ];

        // return $this->query($query, $data); 

        // Prepare the query to insert data into the "cases" table
        $query = "INSERT INTO {$this->table} 
                  (name, email, message,created_at)
                  VALUES 
                  (:name, :email, :message , :created_at)";

        // Bind parameters to prevent SQL injection
        $params = [
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['message'],
            'created_at' => $data['created_at'],
        ];

        // Execute the query using the parent Model class's query method
        return $this->query($query, $params);
    }
}
