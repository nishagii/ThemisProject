<?php


class Inquire
{
    use Controller;  

    public function index()
    {
        
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get and sanitize input
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $message = trim($_POST['message']);

            // Validations
            if (empty($name)) {
                $errors['name'] = 'Name is required.';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Valid email is required.';
            }

            if (empty($message) || strlen($message) < 10) {
                $errors['message'] = 'Message must be at least 10 characters long.';
            }

            // If no errors, save to the database
            if (empty($errors)) {
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'message' => $message,
                ];

                $inquireModel = $this->loadModel('inquireModel');
                $inquireModel->save($data);
                // Insert query
                // $query = "INSERT INTO inquiries (name, email, message, created_at) VALUES (:name, :email, :message, NOW())";
                // $this->query($query, $data); // Use the `query` method from the Database trait

                // $_SESSION['success'] = 'Your message has been sent successfully!';
                // header('Location: ' . ROOT . '/Inquire');
                // exit;
            }
        }

        // Load the view with errors (if any)
        $this->view('/landingPage/inquire', ['errors' => $errors]);
    }
}
