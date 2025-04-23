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
                  (client_id, client_registered, client_name, client_number, client_email, client_address, 
                   case_number, court, notes, attorney_id, junior_id, case_status)
                  VALUES 
                  (:client_id, :client_registered, :client_name, :client_number, :client_email, :client_address, 
                   :case_number, :court, :notes, :attorney_id, :junior_id, :case_status)";

        // Bind parameters to prevent SQL injection
        $params = [
            'client_id' => $data['client_id'] ?? null,
            'client_registered' => $data['client_registered'] ?? 0,
            'client_name' => $data['client_name'],
            'client_number' => $data['client_number'],
            'client_email' => $data['client_email'],
            'client_address' => $data['client_address'],
            'case_number' => $data['case_number'],
            'court' => $data['court'],
            'notes' => $data['notes'],
            'attorney_id' => $data['attorney_id'] ?? null,
            'junior_id' => $data['junior_id'] ?? null,
            'case_status' => $data['case_status'] ?? 'Active'
        ];

        // Execute the query using the parent Model class's query method
        return $this->query($query, $params);
    }


    // Get all non-deleted cases
    public function getAllCases()
    {
        $query = "SELECT c.*, 
              a.first_name as attorney_first_name, a.last_name as attorney_last_name,
              j.first_name as junior_first_name, j.last_name as junior_last_name
              FROM {$this->table} c
              LEFT JOIN users a ON c.attorney_id = a.id
              LEFT JOIN users j ON c.junior_id = j.id
              WHERE c.deleted = 0
              ORDER BY c.created_at DESC";
        return $this->query($query);
    }

    // Get a specific non-deleted case by ID
    public function getCaseById($id)
    {
        $query = "SELECT c.*, 
              a.first_name as attorney_first_name, a.last_name as attorney_last_name,
              j.first_name as junior_first_name, j.last_name as junior_last_name
              FROM {$this->table} c
              LEFT JOIN users a ON c.attorney_id = a.id
              LEFT JOIN users j ON c.junior_id = j.id
              WHERE c.id = :id AND c.deleted = 0";
        $params = ['id' => $id];

        $result = $this->query($query, $params);

        // Check if result is empty
        if (empty($result)) {
            return null; // Return null if no case is found
        }

        return $result[0]; // Return the first (and expected only) result
    }

    // Soft delete a case (mark as deleted instead of removing from database)
    public function softDeleteCase($caseId)
    {
        $query = "UPDATE {$this->table} SET deleted = 1, updated_at = NOW() WHERE id = :id";
        $params = ['id' => $caseId];
        return $this->query($query, $params);
    }


    // Optional: Get all deleted cases (for admin/restoration purposes)
    public function getDeletedCases()
    {
        $query = "SELECT c.*, 
              a.first_name as attorney_first_name, a.last_name as attorney_last_name,
              j.first_name as junior_first_name, j.last_name as junior_last_name
              FROM {$this->table} c
              LEFT JOIN users a ON c.attorney_id = a.id
              LEFT JOIN users j ON c.junior_id = j.id
              WHERE c.deleted = 1";
        return $this->query($query);
    }

    // Optional: Restore a deleted case
    public function restoreCase($caseId)
    {
        $query = "UPDATE {$this->table} SET deleted = 0, updated_at = NOW() WHERE id = :id";
        $params = ['id' => $caseId];
        return $this->query($query, $params);
    }

    // Update an existing case
    public function updateCase($data)
    {
        $query = "UPDATE {$this->table} 
              SET 
                  client_id = :client_id,
                  client_registered = :client_registered,
                  client_name = :client_name,
                  client_number = :client_number,
                  client_email = :client_email,
                  client_address = :client_address,
                  case_number = :case_number,
                  court = :court,
                  notes = :notes,
                  attorney_id = :attorney_id,
                  junior_id = :junior_id,
                  case_status = :case_status,
                  updated_at = NOW()
              WHERE id = :id";

        $params = [
            'id' => $data['id'],
            'client_id' => $data['client_id'] ?? null,
            'client_registered' => $data['client_registered'] ?? 0,
            'client_name' => $data['client_name'],
            'client_number' => $data['client_number'],
            'client_email' => $data['client_email'],
            'client_address' => $data['client_address'],
            'case_number' => $data['case_number'],
            'court' => $data['court'],
            'notes' => $data['notes'],
            'attorney_id' => $data['attorney_id'] ?? null,
            'junior_id' => $data['junior_id'] ?? null,
            'case_status' => $data['case_status'] ?? 'Active'
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

    // Get cases by client email
    public function getCasesByClientEmail($email)
    {
        $query = "SELECT c.*, 
                  a.first_name as attorney_first_name, a.last_name as attorney_last_name,
                  j.first_name as junior_first_name, j.last_name as junior_last_name
                  FROM {$this->table} c
                  LEFT JOIN users a ON c.attorney_id = a.id
                  LEFT JOIN users j ON c.junior_id = j.id
                  WHERE c.client_email = :email";
        $params = ['email' => $email];

        return $this->query($query, $params);
    }

    // Get cases by client ID
    public function getCasesByClientId($clientId)
    {
        $query = "SELECT c.*, 
                  a.first_name as attorney_first_name, a.last_name as attorney_last_name,
                  j.first_name as junior_first_name, j.last_name as junior_last_name
                  FROM {$this->table} c
                  LEFT JOIN users a ON c.attorney_id = a.id
                  LEFT JOIN users j ON c.junior_id = j.id
                  WHERE c.client_id = :client_id";
        $params = ['client_id' => $clientId];

        return $this->query($query, $params);
    }

    // Get cases by attorney ID
    public function getCasesByAttorneyId($attorneyId)
    {
        $query = "SELECT * FROM {$this->table} WHERE attorney_id = :attorney_id";
        $params = ['attorney_id' => $attorneyId];

        return $this->query($query, $params);
    }

    // Get cases by junior ID
    public function getCasesByJuniorId($juniorId)
    {
        $query = "SELECT * FROM {$this->table} WHERE junior_id = :junior_id";
        $params = ['junior_id' => $juniorId];

        return $this->query($query, $params);
    }

    // Update only the case status
    public function updateCaseStatus($data)
    {
        $query = "UPDATE {$this->table} 
              SET case_status = :case_status,
                  updated_at = NOW()
              WHERE id = :id";

        $params = [
            'id' => $data['id'],
            'case_status' => $data['case_status']
        ];

        return $this->query($query, $params);
    }

    // Search cases
    public function searchCases($query, $field = 'all')
    {
        // Base query
        $sql = "SELECT * FROM {$this->table} WHERE deleted = 0 AND ";

        // Add search conditions based on field
        if ($field === 'all') {
            $sql .= "(case_number LIKE :query OR 
                 client_name LIKE :query OR 
                 court LIKE :query OR 
                 notes LIKE :query)";
            $params = ['query' => "%{$query}%"];
        } else {
            $sql .= "{$field} LIKE :query";
            $params = ['query' => "%{$query}%"];
        }

        return $this->query($sql, $params);
    }
}
