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

public function test() {
    echo "Invoice controller is working!";
    exit;
}

    public function createInvoice() {
        // Get the raw input data
        $inputData = file_get_contents('php://input');
        
        // Try to decode as JSON first
        $jsonData = json_decode($inputData, true);
        
        // If JSON parsing worked, use that data
        if ($jsonData !== null) {
            $data = $jsonData;
            error_log("Received JSON data: " . print_r($data, true));
        } 
        // Otherwise, fall back to POST data
        // Otherwise, fall back to POST data
        else {
            $data = [
                'clientID' => $_POST['clientID'] ?? '',
                'caseID' => $_POST['caseID'] ?? '',
                'comments' => $_POST['comments'] ?? '',
                'paymentDesc' => $_POST['paymentDesc'] ?? '',
                'amount' => $_POST['amount'] ?? '',
                'dueDate' => $_POST['dueDate'] ?? '',
                'invoiceID' => 'INV' . rand(1000, 9999)  // Corrected line
            ];
            error_log("Received POST data: " . print_r($data, true));
        }

        // Validate the data
        $errors = [];
        if (empty($data['clientID'])) {
            $errors['clientID'] = 'Client ID is required';
        }
        if (empty($data['caseID'])) {
            $errors['caseID'] = 'Case ID is required';
        }
        if (empty($data['paymentDesc'])) {
            $errors['paymentDesc'] = 'Payment description is required';
        }
        if (empty($data['amount'])) {
            $errors['amount'] = 'Amount is required';
        }
        if (empty($data['dueDate'])) {
            $errors['dueDate'] = 'Due date is required';
        }

        // If there are validation errors
        if (!empty($errors)) {
            // Return errors as JSON
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'errors' => $errors]);
            return;
        }

        // Save the invoice data to the database
        $invoiceModel = $this->loadModel('InvoiceModel');
        $result = $invoiceModel->save($data);
        
        // Return response
        // header('Content-Type: application/json');
        // if ($result) {
        //     echo json_encode(['success' => true, 'message' => 'Invoice created successfully']);
        // } else {
        //     echo json_encode(['success' => false, 'message' => 'Failed to create invoice']);
        // }

        $userModel = $this->loadModel('UserModel');
        $clientID = (int) $data['clientID'];
        $client = $userModel->getUserByID($clientID);
        if (!$client) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Client not found']);
            return;
        }
        

        $invoiceData = [
            'client' => $client,
            'caseID' => $data['caseID'],
            'paymentDesc' => $data['paymentDesc'],
            'amount' => $data['amount'],
            'dueDate' => $data['dueDate'],
            'comments' => $data['comments'],
            'invoiceDate' => date('Y-m-d'),
            'invoiceID' => $data['invoiceID']
        ];

        $this->view('seniorCounsel/invoiceGenerate', ['invoiceData' => $invoiceData]);
    }

    public function markInvoiceAsSent($id)
    {
        // Check if ID is valid
        if (!$id) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid or missing invoice ID']);
            return;
        }

        error_log("Starting markInvoiceAsSent for invoice ID: $id");
        
        $invoiceModel = $this->loadModel('InvoiceModel');
        
        // First, get the invoice details to find the client ID
        try {
            $invoice = $invoiceModel->getInvoiceById($id);
            error_log("Invoice data retrieved: " . print_r($invoice, true));
            
            if (!$invoice) {
                error_log("Invoice not found with ID: $id");
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Invoice not found']);
                return;
            }
            
            // Mark the invoice as sent
            $result = $invoiceModel->markAsSent($id);
            error_log("markAsSent result: " . ($result ? 'success' : 'failed'));
            
            if ($result) {
                // Create a notification for the client
                $notificationModel = $this->loadModel('NotificationModel');
                
                $notificationData = [
                    'user_id' => $invoice->clientID, // Using the client ID as user ID
                    'message' => "Invoice #$id has been sent to you. Please check your email.",
                    'timestamp' => date('Y-m-d H:i:s'),
                    'status' => 'unread'
                ];
                error_log("Creating notification with data: " . print_r($notificationData, true));
                
                $notificationResult = $notificationModel->createNotification($notificationData);
                error_log("createNotification result: " . ($notificationResult ? 'success' : 'failed'));
                
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Invoice marked as sent and notification created']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Failed to update invoice']);
            }
        } catch (Exception $e) {
            error_log("Exception in markInvoiceAsSent: " . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
    
    
    
}


