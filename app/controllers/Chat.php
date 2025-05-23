<?php
class Chat {
    use Controller;
    
    public function index()
    {
        // Set timezone to Sri Lanka
        date_default_timezone_set('Asia/Colombo');

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

        // Check if a POST request is made for saving a message
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Get JSON input since you're sending JSON from JavaScript
            $jsonData = file_get_contents('php://input');
            $postData = json_decode($jsonData, true);

            if ($postData && isset($postData['find'])) {
                // Prepare data in the format your model expects
                $messageData = [
                    'msgid' => $postData['find']['userid'] . 'and' . $postData['find']['receiverid'], // msgid in senderid#receiverid format
                    'sender' => $postData['find']['userid'],
                    'receiver' => $postData['find']['receiverid'],
                    'message' => $postData['find']['message'],
                    'files' => null,
                    'seen' => 0,
                    'received' => 0,
                    'deleted_sender' => 0,
                    'deleted_receiver' => 0,
                    'date' => date('Y-m-d H:i:s') // Capturing the current time in Sri Lankan timezone
                ];

                // Save message data to the database
                $chatModel = $this->loadModel('messageModel');
                $saved = $chatModel->save($messageData);

                // Prepare the response
                $response = [
                    'status' => $saved ? 'success' : 'error',
                    'message' => $saved ? 'Message sent successfully' : 'Failed to save message',
                    'data' => $messageData
                ];

                // Send JSON response
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }
        }
        
        if (isset($_GET['msgid'])) {
            $msgid = $_GET['msgid'];
            $chatModel = $this->loadModel('messageModel');
            $messages = $chatModel->getMessagesByMsgId($msgid);
            
            // Debug logs
            error_log("msgid received: " . $msgid);
            error_log("messages from DB: " . print_r($messages, true));
            
            if (!$messages) {
                $response = [
                    'status' => 'error',
                    'message' => 'No messages found.',
                    'data' => [
                        'messages' => []
                    ]
                ];
                echo json_encode($response);
                exit;
            }
            
            $response = [
                'status' => 'success',
                'data' => [
                    'messages' => $messages
                ]
            ];
            
            // Debug log
            error_log("response being sent: " . json_encode($response));
            
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        // Load the view for GET requests
        $this->view('/seniorCounsel/chat', $data);
    }
}
