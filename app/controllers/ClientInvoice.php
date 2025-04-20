<?php

class ClientInvoice
{
    use Controller;

    public function index()
    {
        // Redirect if not logged in
        if (empty($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        // Get the logged-in user's ID
        $user_id = $_SESSION['user_id'];

        // Set username for the view
        $data['username'] = $_SESSION['username'] ?? 'User';

        // Load the InvoiceModel (note: use the correct case as defined in your filename/class)
        $invoiceModel = $this->loadModel('InvoiceModel');

        // Fetch sent invoices for the logged-in user
        $data['sent_invoices'] = $invoiceModel->getSentInvoicesByClient($user_id);

        // Load the view and pass all data
        $this->view('/client/invoice', $data);
    }
}
