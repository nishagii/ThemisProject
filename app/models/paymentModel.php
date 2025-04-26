<?php

class PaymentModel
{
    use Model;
    protected $table = 'payments'; // Name of the database table

    /**
     * Save a new payment record to the database.
     *
     * @param array $data Associative array containing payment details.
     * @return bool True if the operation was successful, false otherwise.
     */
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


    // ALTER TABLE payments CHANGE id_number remarks VARCHAR(255);
    // ALTER TABLE payments ADD COLUMN remarks VARCHAR(255) AFTER id_number;
    /**
     * Retrieve all payments from the database.
     *
     * @return array List of all payments.
     */
    public function getAllPayments()
    {
        $query = "SELECT * FROM {$this->table}
        ORDER BY created_at ASC";
        return $this->query($query);
    }

    /**
     * Retrieve a specific payment by ID.
     *
     * @param int $id The ID of the payment.
     * @return array|null The payment record or null if not found.
     */
    public function getPaymentById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $params = ['id' => $id];

        $result = $this->query($query, $params);
        return empty($result) ? null : $result[0];
    }


    /**
     * Retrieve all payments with associated case details.
     *
     * @return array List of all payments with case details.
     */
    public function getAllPaymentsWithCaseDetails()
    {
        $query = "SELECT p.*, c.case_number, c.client_name , c.court, c.client_number
                  FROM {$this->table}  p
                  LEFT JOIN cases c ON p.case_number = c.case_number
                  ORDER BY p.created_at DESC";

        $payments = $this->query($query);

        //decrypt sensitive data
        if (!empty($payments)) {
            //load the caseModel to use its decryptSensitiveData method
            $caseModel = new CaseModel();

            foreach ($payments as &$payment){
                // Decrypt the sensitive data
                $payment = $caseModel -> decryptSensitiveData($payment);
            }

            return $payments;
        }
    }

    /**
     * Retrieve total amount received from payments this month.
     * @return int Total amount received in the current month.
     * 
     */
    public function getTotalAmountReceivedInMonth()
    {
        // Get the first and last day of the current month
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
