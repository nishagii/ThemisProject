<?php
require_once '../vendor/autoload.php';
require_once '../core/config.php';

class Payments
{
    use Controller;

    public function index()
    {
        // Render the "Make Payment" view
        $this->view('/payments/make_payment');
    }

    // Create a new payment session using Stripe
    public function createCheckoutSession()
    {
        \Stripe\Stripe::setApiKey(STRIPE_SECRET);

        header('Content-Type: application/json');

        $amount = $_POST['amount'] * 100; // Convert to cents
        $user_id = $_POST['user_id'];

        try {
            $checkout_session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'lkr',
                        'product_data' => [
                            'name' => 'Lawyer Payment',
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => 'http://yourwebsite.com/payments/paymentSuccess?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'http://yourwebsite.com/payments/paymentCancel',
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
            'user_id' => $session->metadata->user_id,
            'amount' => $session->amount_total / 100,
            'status' => $session->payment_status,
            'transaction_id' => $session->id,
        ];

        $paymentModel = $this->loadModel('PaymentModel');
        $paymentModel->save($paymentData);

        $_SESSION['success'] = 'Payment completed successfully!';
        redirect('payments/retrieveAllPayments');
    }

    // Handle payment cancellation
    public function paymentCancel()
    {
        $_SESSION['error'] = 'Payment was canceled.';
        redirect('payments/index');
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
