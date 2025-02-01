<?php


class UserModel
{
    use Model;

    protected $table = 'users';
    public $errors = [];

   
    // Save user to the database
    public function save($data)
    {
        // Determine role: Use provided role or default to 'client'
        $role = isset($data['role']) ? $data['role'] : 'client';

        $query = "INSERT INTO users 
              (first_name, last_name, username, email, phone, password,role)
              VALUES 
              (:first_name, :last_name, :username, :email, :phone, :password,:role)";

        $params = [
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['tel'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => $role 
        ];

        try {
            $stmt = $this->connect()->prepare($query);
            $result = $stmt->execute($params);

            if (!$result) {
                echo "Database Error: ";
                print_r($stmt->errorInfo());
            }
            return $result;
        } catch (PDOException $e) {
            echo "PDO Error: " . $e->getMessage();
            return false;
        }
    }




    // Validate user data
    public function validate($data)
    {
        $this->errors = [];

        // Validate first name
        if (empty($data['firstname'])) {
            $this->errors['firstname'] = "First name is required.";
        }

        // Validate last name
        if (empty($data['lastname'])) {
            $this->errors['lastname'] = "Last name is required.";
        }

        // Validate username
        if (empty($data['username'])) {
            $this->errors['username'] = "Username is required.";
        } elseif ($this->usernameExists($data['username'])) {
            $this->errors['username'] = "This username is already taken.";
        }

        // Validate email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Valid email is required.";
        } elseif ($this->emailExists($data['email'])) {
            $this->errors['email'] = "This email is already registered.";
        }

        // Validate phone number
        if (empty($data['tel']) || !preg_match('/^[0-9]{10}$/', $data['tel'])) {
            $this->errors['tel'] = "Valid phone number is required.";
        }elseif ($this->phoneExists($data['tel'])) {
            $this->errors['tel'] = "This phone number is already registered.";
        }

        // Validate password
        if (empty($data['password']) || strlen($data['password']) < 2) {
            $this->errors['password'] = "Password must be at least 2 characters long.";
        }

        // Confirm password match
        if ($data['password'] !== $data['confirm_password']) {
            $this->errors['confirm_password'] = "Passwords do not match.";
        }

        return empty($this->errors);
    }

    // Check if email exists in the database
    private function emailExists($email)
    {
        $query = "SELECT id FROM users WHERE email = :email LIMIT 1";
        $params = ['email' => $email];

        try {
            $stmt = $this->connect()->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
        } catch (PDOException $e) {
            echo "PDO Error: " . $e->getMessage();
            return false;
        }
    }

    // Check if username exists in the database
    private function usernameExists($username)
    {
        $query = "SELECT id FROM users WHERE username = :username LIMIT 1";
        $params = ['username' => $username];

        try {
            $stmt = $this->connect()->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
        } catch (PDOException $e) {
            echo "PDO Error: " . $e->getMessage();
            return false;
        }
    }

    //check if phone number exists in the database
    private function phoneExists($phone)
    {
        $query = "SELECT id FROM users WHERE phone = :phone LIMIT 1";
        $params = ['phone' => $phone];
        try {
            $stmt = $this->connect()->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
        } catch (PDOException $e) {
            echo "PDO Error: " . $e->getMessage();
            return false;
        }
    }



    public function login($data)
    {
        $query = "SELECT * FROM users WHERE (email = :email OR username = :username) LIMIT 1";

        $params = [
            'email' => $data['username'],
            'username' => $data['username']
        ];

        try {
            $stmt = $this->connect()->prepare($query);
            $stmt->execute($params);
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            if ($user && password_verify($data['password'], $user->password)) {
                return $user;
            }
        } catch (PDOException $e) {
            return false;
        }

        return false;
    }

    public function getJuniorsAndAttorneys()
    {
        $query = "SELECT * FROM users WHERE role IN ('junior', 'attorney')";

        try {
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $users;
        } catch (PDOException $e) {
            echo "PDO Error: " . $e->getMessage();
            return false;
        }
    }

    public function getAllUsers()
{
    $query = "SELECT * FROM users";

    try {
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        echo "PDO Error: " . $e->getMessage();
        return false;
    }
}

}
