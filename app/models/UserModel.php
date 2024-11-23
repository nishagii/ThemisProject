<?php

class UserModel
{
    use Model;

    protected $table = 'users';
    public $errors = [];

    // Save user to the database
    public function save($data)
    {
        $query = "INSERT INTO users 
              (first_name, last_name, username, email, phone, password)
              VALUES 
              (:first_name, :last_name, :username, :email, :phone, :password)";

        $params = [
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['tel'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ];

        try {
            $stmt = $this->connect()->prepare($query);
            $result = $stmt->execute($params);

            if (!$result) {
                $this->errors['general'] = "Database error: Could not save user.";
            }
            return $result;
        } catch (PDOException $e) {
            $this->errors['general'] = "PDO Error: " . $e->getMessage();
            return false;
        }
    }

    // Validate user data
    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['firstname'])) {
            $this->errors['firstname'] = "First name is required.";
        }

        if (empty($data['lastname'])) {
            $this->errors['lastname'] = "Last name is required.";
        }

        if (empty($data['username'])) {
            $this->errors['username'] = "Username is required.";
        } elseif (strlen($data['username']) < 5) {
            $this->errors['username'] = "Username must be at least 5 characters long.";
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Valid email is required.";
        }

        if (empty($data['tel']) || !preg_match('/^[0-9]{10}$/', $data['tel'])) {
            $this->errors['tel'] = "Valid phone number is required.";
        }

        if (empty($data['password']) || strlen($data['password']) < 8) {
            $this->errors['password'] = "Password must be at least 8 characters long.";
        }

        if ($data['password'] !== $data['confirm_password']) {
            $this->errors['confirm_password'] = "Passwords do not match.";
        }

        if (!isset($data['terms'])) {
            $this->errors['terms'] = "You must agree to the terms and conditions.";
        }

        return empty($this->errors);
    }
}