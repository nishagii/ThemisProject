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
            'role' => 'client' // Automatically assign 'client' as the default role
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

        if (empty($data['firstname'])) {
            $this->errors['firstname'] = "First name is required.";
        }

        if (empty($data['lastname'])) {
            $this->errors['lastname'] = "Last name is required.";
        }

        if (empty($data['username'])) {
            $this->errors['username'] = "Username is required.";
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Valid email is required.";
        }

        if (empty($data['tel']) || !preg_match('/^[0-9]{10}$/', $data['tel'])) {
            $this->errors['tel'] = "Valid phone number is required.";
        }

        if (empty($data['password']) || strlen($data['password']) < 2) {
            $this->errors['password'] = "Password must be at least 2 characters long.";
        }

        if ($data['password'] !== $data['confirm_password']) {
            $this->errors['confirm_password'] = "Passwords do not match.";
        }

        return empty($this->errors);
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
}
