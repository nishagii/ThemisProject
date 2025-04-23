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
                  (case_number, id_number, amount, payment_status, transaction_id, created_at) 
                  VALUES (:case_number, :id_number, :amount, :payment_status, :transaction_id, NOW())";

        $params = [
            'case_number' => $data['case_number'],
            'id_number' => $data['id_number'],
            'amount' => $data['amount'],
            'payment_status' => $data['payment_status'],
            'transaction_id' => $data['transaction_id'],
        ];

        return $this->query($query, $params);
    }

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
     * Delete a payment record by ID.
     *
     * @param int $id The ID of the payment to delete.
     * @return bool True if deletion was successful, false otherwise.
     */
    public function deletePayment($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $params = ['id' => $id];

        return $this->query($query, $params);
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

                  return $this->query($query);
    }
}
