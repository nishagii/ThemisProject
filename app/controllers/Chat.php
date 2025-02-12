<?php

class Chat
{
    use Controller;

    public function index()
    {
        // Ensure session is started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $userModel = $this->loadModel('UserModel');
        $users = $userModel->getAllUsers();

        // Pass user session data
        $data['user'] = isset($_SESSION['user_id']) ? [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'] ?? 'User',
            'role' => $_SESSION['role'] ?? 'lawyer'
        ] : null;

        $data['users'] = $users;

        // Handle POST request
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['message'])) {
            $message = trim($_POST['message']);
            $receiverId = $_POST['receiver_id'] ?? null;

            if (!empty($message) && $receiverId) {
                // Add the message to the dummy messages array
                $dummyMessages[] = [
                    'sender_id' => $_SESSION['user_id'],
                    'receiver_id' => $receiverId,
                    'message' => $message
                ];

                // Create a response array
                $response = [
                    'status' => 'success',
                    'message' => 'Message received successfully',
                    'data' => $dummyMessages
                ];

                // Send JSON response
                echo json_encode($response);
                exit; // Ensure no further output
            } else {
                // Handle error case
                $response = [
                    'status' => 'error',
                    'message' => 'Message is empty or receiver is missing!'
                ];

                echo json_encode($response);
                exit;
            }
        }

        // Load the view and pass session & users data
        $this->view('/seniorCounsel/chat', $data);
    }
}
