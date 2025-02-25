<?php


class Invoice
{
    use Controller;

    public function index()
    {
        $UserModel = $this->loadModel('UserModel');
        $client = $UserModel->getAllClients();
        $this->view('seniorCounsel/invoice', ['client' => $client]);
    }

    public function getCaseNumberByClient()
{
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Log to see if the email is correctly passed
    error_log("Received data: " . print_r($data, true));  // This will log the input data

    if (isset($data['email'])) {
        $clientEmail = $data['email'];
        $CaseModel = $this->loadModel('CaseModel');

        // Fetch case numbers for the client based on email
        $caseNumbers = $CaseModel->getCaseNumbersByEmail($clientEmail);

        if ($caseNumbers) {
            // Return JSON response with case numbers
            echo json_encode(['caseNumbers' => $caseNumbers]);
        } else {
            // Return an empty array if no case numbers were found
            echo json_encode(['caseNumbers' => []]);
        }
    } else {
        // Handle the case when no email is provided
        echo json_encode(['error' => 'No email provided']);
    }
}


    
}


