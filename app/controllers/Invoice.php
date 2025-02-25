<?php


class Invoice
{
    use Controller;

    public function index()

    {
        $UserModel = $this->loadModel('UserModel'); 
        $client = $UserModel->getAllClients(); // Fetch cases data
        // var_dump($client); die();
        $this->view('seniorCounsel/invoice', ['client' => $client]);

    }
}
