<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

require_once '../vendor/autoload.php';

// require_once '/Applications/XAMPP/xamppfiles/htdocs/themisrepo/app/core/config.php'; //for MAC

//for windows 

// require_once 'C:\xampp\htdocs\themisrepo\app\core\config.php';

// Use a relative path from the current file (fixed this to avoid hardcoding the path for different environments) 
require_once dirname(__DIR__) . '/core/config.php';




class PaymentController
{
    use Controller;

    public function __construct()
    {
        $this->requireLogin();
    }

    public function index()
    {

        $this->requireRole(['client']);

        if (empty($_SESSION['user_id'])) {
            redirect('login');
            return;
        }


        $username = $_SESSION['username'] ?? 'User';
        $email = $_SESSION['email'] ?? NULL;


        $data = [
            'username' => $username,
            'user_email' => $email,
            'cases' => []
        ];


        if ($email) {
            $caseModel = $this->loadModel('CaseModel');
            $data['cases'] = $caseModel->getCasesByClientEmail($email);
        }

        $this->view('client/payments', $data);
    }


    public function createCheckoutSession()
    {
        \Stripe\Stripe::setApiKey(STRIPE_SECRET);

        header('Content-Type: application/json');


        $data = json_decode(file_get_contents("php://input"), true);


        $case_number = $data['case_number'] ?? null;
        $remarks = $data['remarks'] ?? null;
        $amount = isset($data['amount']) ? $data['amount'] * 100 : null;

        if (!$case_number || !$amount) {
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
                'cancel_url' => ROOT . '/PaymentController/paymentCancel',
                'metadata' => [
                    'case_number' => $case_number,
                    'remarks' => $remarks,
                ]
            ]);

            echo json_encode(['id' => $checkout_session->id]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }


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
            'remarks' => $session->metadata->remarks, // Changed from id_number to remarks
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


    public function paymentCancel()
    {
        $_SESSION['error'] = 'Payment was canceled.';
        redirect('PaymentController');
    }


    public function retrieveAllPayments()
    {
        $paymentModel = $this->loadModel('PaymentModel');
        $payments = $paymentModel->getAllPayments();

        $this->view('/payments/all_payments', ['payments' => $payments]);
    }


    public function retrievePayment($paymentId)
    {
        $paymentModel = $this->loadModel('PaymentModel');
        $payment = $paymentModel->getPaymentById($paymentId);

        $this->view('/payments/payment_details', ['payment' => $payment]);
    }
}
