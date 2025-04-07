<?php

class InvoiceModel
{
    use Model; 
    protected $table = 'invoice'; // Name of the database table for invoices

    /**
     * Save a new invoice to the database.
     *
     * @param array $data Associative array containing invoice details.
     * @return bool True if the operation was successful, false otherwise.
     */
    public function save($data)
    {
        // Prepare the query to insert data into the "invoice" table
        $query = "INSERT INTO {$this->table} 
                  (clientID, caseID, comments, paymentDesc, amount, dueDate)
                  VALUES 
                  (:clientID, :caseID, :comments, :paymentDesc, :amount, :dueDate)";

        // Bind parameters to prevent SQL injection
        $params = [
            'clientID' => $data['clientID'],
            'caseID' => $data['caseID'],
            'comments' => $data['comments'],
            'paymentDesc' => $data['paymentDesc'],
            'amount' => $data['amount'],
            'dueDate' => $data['dueDate'],
        ];

        // Execute the query using the parent Model class's query method
        return $this->query($query, $params);
    }

}