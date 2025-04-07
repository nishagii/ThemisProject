<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

require_once '../vendor/autoload.php';
// require_once '/Applications/XAMPP/xamppfiles/htdocs/themisrepo/app/core/config.php'; //for MAC
//for windows 

require_once 'C:\xampp\htdocs\themisrepo\app\core\config.php';


class PaymentController
{
    use Controller;

    public function index()
    {
        $this->view('/client/payments');
    }

    // Create a new payment session using Stripe
    public function createCheckoutSession()
    {
        \Stripe\Stripe::setApiKey(STRIPE_SECRET);

        header('Content-Type: application/json');

        // Decode JSON input
        $data = json_decode(file_get_contents("php://input"), true);

        // Validate input
        $case_number = $data['case_number'] ?? null;
        $id_number = $data['id_number'] ?? null;
        $amount = isset($data['amount']) ? $data['amount'] * 100 : null; // Convert to cents

        if (!$case_number || !$id_number || !$amount) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required fields']);
            exit;
        }

        try {
            $checkout_session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Themis Payment for Case #' . $case_number,
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => ROOT . '/PaymentController/paymentSuccess?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => ROOT . '/payments/paymentCancel',
                'metadata' => [
                    'case_number' => $case_number,
                    'id_number' => $id_number,
                ]
            ]);

            echo json_encode(['id' => $checkout_session->id]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    // Handle payment success
    public function paymentSuccess()
    {
        $session_id = $_GET['session_id'] ?? '';
        if (!$session_id) {
            die("Invalid session ID");
        }

        \Stripe\Stripe::setApiKey(STRIPE_SECRET);
        $session = \Stripe\Checkout\Session::retrieve($session_id);

        $paymentData = [
            'case_number' => $session->metadata->case_number,
            'id_number' => $session->metadata->id_number,
            'amount' => $session->amount_total / 100,
            'payment_status' => $session->payment_status,
            'transaction_id' => $session->id,
        ];
        // var_dump($paymentData); 
        // die();

        $paymentModel = $this->loadModel('PaymentModel');
        $paymentModel->savePayment($paymentData);

        $_SESSION['success'] = 'Payment completed successfully!';
        $this->view('/client/payment_success');
    }

    // Handle payment cancellation
    public function paymentCancel()
    {
        $_SESSION['error'] = 'Payment was canceled.';
        redirect('PaymentController');
    }

    // Retrieve all payments
    public function retrieveAllPayments()
    {
        $paymentModel = $this->loadModel('PaymentModel');
        $payments = $paymentModel->getAllPayments();

        $this->view('/payments/all_payments', ['payments' => $payments]);
    }

    // Retrieve a single payment by ID
    public function retrievePayment($paymentId)
    {
        $paymentModel = $this->loadModel('PaymentModel');
        $payment = $paymentModel->getPaymentById($paymentId);

        $this->view('/payments/payment_details', ['payment' => $payment]);
    }

    // Delete a payment record
    public function deletePayment($paymentId)
    {
        $paymentModel = $this->loadModel('PaymentModel');
        $paymentModel->deletePayment($paymentId);

        redirect('payments/retrieveAllPayments');
    }
}
