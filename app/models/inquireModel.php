<?php

class InquireModel extends Database
{
    public function saveInquiry($name, $email, $message)
    {
        $query = "INSERT INTO inquiries (name, email, message, created_at) 
                  VALUES (:name, :email, :message, NOW())";
        $data = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
        ];

        return $this->query($query, $data); // Returns true if the query is successful
    }
}
