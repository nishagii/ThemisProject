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
    public function emailExists($email)
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


    public function getAllClients(){

        $query= "SELECT * from users WHERE role = 'client'";

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

        public function getUserByID($id)
    {
        $query = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $params = ['id' => $id];

        try {
            $stmt = $this->connect()->prepare($query);
            $stmt->execute($params);
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            return $user ?: null; // Return the user object or null if not found
        } catch (PDOException $e) {
            echo "PDO Error: " . $e->getMessage();
            return false;
        }
    }

    public function getUsersByRole($role)
    {
        // Query to select all users with the specified role
        $query = "SELECT * FROM {$this->table} WHERE role = :role";
        $params = ['role' => $role];

        // Execute the query and return the results
        return $this->query($query, $params);
    }

    public function countUsers()
    {
        $query = "SELECT COUNT(*) as total FROM {$this->table}";
        try {
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $result['total']; // Return just the number
        } catch (PDOException $e) {
            echo "PDO Error: " . $e->getMessage();
            return 0;
        }
        
    }
    
    public function countClients()
    {
        $query = "SELECT COUNT(*) as total FROM {$this->table} WHERE role = 'client'";
        
        try {
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['total']; // Return the number of clients
        } catch (PDOException $e) {
            echo "PDO Error: " . $e->getMessage();
            return 0;
        }
    }

    // Save OTP for password reset
    public function saveResetOTP($email, $otp)
    {
        // First, let's create a reset_tokens table if it doesn't exist
        $this->createResetTokensTable();

        // Delete any existing tokens for this email
        $deleteQuery = "DELETE FROM reset_tokens WHERE email = :email";
        $deleteParams = ['email' => $email];

        try {
            $stmt = $this->connect()->prepare($deleteQuery);
            $stmt->execute($deleteParams);
        } catch (PDOException $e) {
            return false;
        }

        // Insert new token
        $query = "INSERT INTO reset_tokens (email, token, expires_at) VALUES (:email, :token, :expires_at)";
        $params = [
            'email' => $email,
            'token' => $otp,
            'expires_at' => date('Y-m-d H:i:s', strtotime('+15 minutes')) // Token expires in 15 minutes
        ];

        try {
            $stmt = $this->connect()->prepare($query);
            $result = $stmt->execute($params);
            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Verify OTP
    public function verifyOTP($email, $otp)
    {
        $query = "SELECT * FROM reset_tokens 
              WHERE email = :email 
              AND token = :token 
              AND expires_at > :now 
              LIMIT 1";

        $params = [
            'email' => $email,
            'token' => $otp,
            'now' => date('Y-m-d H:i:s')
        ];

        try {
            $stmt = $this->connect()->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Update user password
    public function updatePassword($email, $password)
    {
        $query = "UPDATE users SET password = :password WHERE email = :email";
        $params = [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        try {
            $stmt = $this->connect()->prepare($query);
            $result = $stmt->execute($params);

            if ($result) {
                // Delete the used token
                $deleteQuery = "DELETE FROM reset_tokens WHERE email = :email";
                $deleteParams = ['email' => $email];
                $deleteStmt = $this->connect()->prepare($deleteQuery);
                $deleteStmt->execute($deleteParams);
            }

            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Create reset_tokens table if it doesn't exist
    private function createResetTokensTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS reset_tokens (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        token VARCHAR(10) NOT NULL,
        expires_at DATETIME NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

        try {
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}
