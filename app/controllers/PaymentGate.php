<?php


class PaymentGate
{
    use Controller;

    public function index()
    {
        $this->view('seniorCounsel/payments');
    }
}
