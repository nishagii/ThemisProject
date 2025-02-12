
<?php
class Chat {
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
        
        // Handle JSON POST request
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Get JSON input
            $json = file_get_contents('php://input');
            $postData = json_decode($json, true);
            
            if ($json && $postData) {
                // Handle the JSON data
                $find = $postData['find'] ?? null;
                $dataType = $postData['data_type'] ?? null;
                
                // Process the data and prepare response
                $response = [
                    'status' => 'success',
                    'message' => 'Data received successfully',
                    'data' => [
                        'find' => $find,
                        'type' => $dataType
                        // Add any additional processed data here
                    ]
                ];
                
                // Send JSON response
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            } else {
                // Handle invalid JSON
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid JSON data received'
                ]);
                exit;
            }
        }
        
        // Load the view for GET requests
        $this->view('/seniorCounsel/chat', $data);
    }
}