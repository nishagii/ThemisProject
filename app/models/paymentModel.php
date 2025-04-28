<?php

class PaymentModel
{
    use Model;
    protected $table = 'payments'; 

 
    public function savePayment($data)
    {
        $query = "INSERT INTO {$this->table} 
                  (case_number,remarks, amount, payment_status, transaction_id, created_at) 
                  VALUES (:case_number, :remarks, :amount, :payment_status, :transaction_id, NOW())";

        $params = [
            'case_number' => $data['case_number'],
            'remarks' => $data['remarks'],
            'amount' => $data['amount'],
            'payment_status' => $data['payment_status'],
            'transaction_id' => $data['transaction_id'],
        ];

        return $this->query($query, $params);
    }



    public function getAllPayments()
    {
        $query = "SELECT * FROM {$this->table}
        ORDER BY created_at ASC";
        return $this->query($query);
    }


    public function getPaymentById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $params = ['id' => $id];

        $result = $this->query($query, $params);
        return empty($result) ? null : $result[0];
    }


  
    public function getAllPaymentsWithCaseDetails()
    {
        $query = "SELECT p.*, c.case_number, c.client_name , c.court, c.client_number
                  FROM {$this->table}  p
                  LEFT JOIN cases c ON p.case_number = c.case_number
                  ORDER BY p.created_at DESC";

        $payments = $this->query($query);

   
        if (!empty($payments)) {
            //load the caseModel to use its decryptSensitiveData method
            $caseModel = new CaseModel();

            foreach ($payments as &$payment){
             
                $payment = $caseModel -> decryptSensitiveData($payment);
            }

            return $payments;
        }
    }


    public function getTotalAmountReceivedInMonth()
    {
       
        $firstDayOfMonth = date('Y-m-01');
        $lastDayOfMonth = date('Y-m-t');

        $query = "SELECT SUM(amount) as total_amount FROM {$this->table} 
              WHERE created_at BETWEEN :start_date AND :end_date";

        $params = [
            'start_date' => $firstDayOfMonth,
            'end_date' => $lastDayOfMonth . ' 23:59:59'
        ];

        $result = $this->query($query, $params);
        return $result[0]->total_amount ?? 0;
    }
}
