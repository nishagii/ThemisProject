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
}
