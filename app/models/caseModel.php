<?php

class CaseModel
{
    use Model;
    protected $table = 'cases'; // Name of the database table

    /**
     * Save a new case to the database.
     *
     * @param array $data Associative array containing case details.
     * @return bool True if the operation was successful, false otherwise.
     */
    public function save($data)
    {
        // Prepare the query to insert data into the "cases" table
        $query = "INSERT INTO {$this->table} 
                  (client_name, client_number, client_email, client_address, 
                   attorney_name, junior_counsel_name, case_number, court, notes)
                  VALUES 
                  (:client_name, :client_number, :client_email, :client_address, 
                   :attorney_name, :junior_counsel_name, :case_number, :court, :notes)";

        // Bind parameters to prevent SQL injection
        $params = [
            'client_name' => $data['client_name'],
            'client_number' => $data['client_number'],
            'client_email' => $data['client_email'],
            'client_address' => $data['client_address'],
            'attorney_name' => $data['attorney_name'],
            'junior_counsel_name' => $data['junior_counsel_name'],
            'case_number' => $data['case_number'],
            'court' => $data['court'],
            'notes' => $data['notes'],
        ];

        // Execute the query using the parent Model class's query method
        return $this->query($query, $params);
    }

    // Retrieve all cases
    public function getAllCases()
    {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }

    //delete case
    public function deleteCase($caseId)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $params = ['id' => $caseId];
        return $this->query($query, $params);
    }

    // Get a specific case by ID
    public function getCaseById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $params = ['id' => $id];

        $result = $this->query($query, $params);

        // Check if result is empty
        if (empty($result)) {
            return null; // Return null if no case is found
        }

        return $result[0]; // Return the first (and expected only) result
    }

    // Update an existing case
    public function updateCase($data)
    {
        $query = "UPDATE {$this->table} 
              SET 
                  client_name = :client_name,
                  client_number = :client_number,
                  client_email = :client_email,
                  client_address = :client_address,
                  attorney_name = :attorney_name,
                  junior_counsel_name = :junior_counsel_name,
                  case_number = :case_number,
                  court = :court,
                  notes = :notes
              WHERE id = :id";

        $params = [
            'id' => $data['id'],
            'client_name' => $data['client_name'],
            'client_number' => $data['client_number'],
            'client_email' => $data['client_email'],
            'client_address' => $data['client_address'],
            'attorney_name' => $data['attorney_name'],
            'junior_counsel_name' => $data['junior_counsel_name'],
            'case_number' => $data['case_number'],
            'court' => $data['court'],
            'notes' => $data['notes'],
        ];

        return $this->query($query, $params);
    }

    // Get case number by email
    public function getCaseNumberByEmail($email)
    {
        $query = "SELECT case_number FROM {$this->table} WHERE client_email = :email";
        $params = ['email' => $email];

        $result = $this->query($query, $params);

        // Check if result is empty
        if (empty($result)) {
            return null; // Return null if no case is found for the given email
        }

        return $result[0]['case_number']; // Return the case number
    }

    // Add this method to the CaseModel class
    public function getCasesByClientEmail($email)
    {
        $query = "SELECT * FROM {$this->table} WHERE client_email = :email";
        $params = ['email' => $email];

        return $this->query($query, $params);
    }
}
