<?php

class PaymentGate
{
    use Controller;

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
        $payments = $paymentModel->getAllPayments();

        $this->view('seniorCounsel/paidReciepts', [
            'payments' => $payments
        ]);
    }


}
