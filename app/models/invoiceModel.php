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
                  (clientID, caseID, comments, paymentDesc, amount, dueDate, invoiceID)
                  VALUES 
                  (:clientID, :caseID, :comments, :paymentDesc, :amount, :dueDate, :invoiceID)";

        // Bind parameters to prevent SQL injection
        $params = [
            'clientID' => $data['clientID'],
            'caseID' => $data['caseID'],
            'comments' => $data['comments'],
            'paymentDesc' => $data['paymentDesc'],
            'amount' => $data['amount'],
            'dueDate' => $data['dueDate'],
            'invoiceID' => $data['invoiceID']
        ];

        // Execute the query using the parent Model class's query method
        return $this->query($query, $params);
    }

    public function markAsSent($invoiceID)
    {
        // Prepare the query to update the "sent" column to 1
        $query = "UPDATE {$this->table} 
                  SET sent = 1 
                  WHERE invoiceID = :invoiceID";

        // Bind the invoiceID parameter
        $params = [
            'invoiceID' => $invoiceID,
        ];

        // Execute the query using the parent Model class's query method
        return $this->query($query, $params);
    }
    public function getSentInvoicesByClient($clientID)
    {
        // Prepare the query to retrieve sent invoices for a specific client
        $query = "SELECT * FROM {$this->table}
                WHERE sent = 1 AND clientID = :clientID";

        // Bind the clientID parameter
        $params = [
            'clientID' => $clientID
        ];

        // Execute the query and return the results
        return $this->query($query, $params);
    }

}