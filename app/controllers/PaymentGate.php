<?php

class PaymentGate
{
    use Controller;

    public function __construct()
    {
       
        $this->requireLogin();
        $this->requireRole(['lawyer']);
    }

    public function index()
    {
        $InvoiceModel = $this->loadModel('InvoiceModel'); 
        $invoices = $InvoiceModel->getAllInvoices();

        $this->view('seniorCounsel/payments', [
            'invoices' => $invoices
        ]);
    }

    public function paidReceipts()
    {
        $paymentModel = $this->loadModel('PaymentModel');
        $payments = $paymentModel->getAllPaymentsWithCaseDetails();

        if (!empty($payments)) {
            //Uncomment to debug
            //  echo "<pre>"; print_r($payments[0]); echo "</pre>"; exit;
        }

        $this->view('seniorCounsel/paidReciepts', [
            'payments' => $payments
        ]);
    }


}
