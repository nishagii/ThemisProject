<?php

class CaseModel
{
    use Model;
    protected $table = 'cases'; // Name of the database table
    private $encryptionKey; // Encryption key
    private $encryptionMethod = 'AES-256-CBC'; // Encryption method

    public function __construct()
    {
        // Initialize encryption key from environment variable
        $this->encryptionKey = getenv('ENCRYPTION_KEY');

        // If not found in environment, use a fallback (for development only)
        if (!$this->encryptionKey) {
            $this->encryptionKey = 'ladiesandgentelements@themis2025@ucscweareencryptednow'; // Fallback key
            error_log("Warning: Using fallback encryption key. Set ENCRYPTION_KEY in environment for security.");
        }
    }

    /**
     * Encrypt data
     * 
     * @param string $data Data to encrypt
     * @return string Encrypted data
     */
    private function encrypt($data)
    {
        if (empty($data)) return $data;

        $ivLength = openssl_cipher_iv_length($this->encryptionMethod);
        $iv = openssl_random_pseudo_bytes($ivLength);

        $encrypted = openssl_encrypt(
            $data,
            $this->encryptionMethod,
            $this->encryptionKey,
            0,
            $iv
        );

        // Return IV + encrypted data, both base64 encoded
        return base64_encode($iv . base64_decode($encrypted));
    }

    /**
     * Decrypt data
     * 
     * @param string $data Data to decrypt
     * @return string Decrypted data
     */
    private function decrypt($data)
    {
        if (empty($data)) return $data;

        try {
            $data = base64_decode($data);
            $ivLength = openssl_cipher_iv_length($this->encryptionMethod);

            // Extract IV and encrypted data
            $iv = substr($data, 0, $ivLength);
            $encrypted = base64_encode(substr($data, $ivLength));

            return openssl_decrypt(
                $encrypted,
                $this->encryptionMethod,
                $this->encryptionKey,
                0,
                $iv
            );
        } catch (Exception $e) {
            // Log error but return original data to prevent application failure
            error_log("Decryption error: " . $e->getMessage());
            return "Error: Could not decrypt data";
        }
    }

    /**
     * Encrypt sensitive fields in the data array
     * 
     * @param array $data Data array with fields to encrypt
     * @return array Data with encrypted fields
     */
    private function encryptSensitiveData($data)
    {
        // Define which fields should be encrypted
        $sensitiveFields = [
            'client_name',
            'client_number',
            'client_email',
            'client_address',
            'notes',
            'case_number'
        ];

        foreach ($sensitiveFields as $field) {
            if (isset($data[$field]) && !empty($data[$field])) {
                $data[$field] = $this->encrypt($data[$field]);
            }
        }

        return $data;
    }

    /**
     * Decrypt sensitive fields in the data object or array
     * 
     * @param object|array $data Data with fields to decrypt
     * @return object|array Data with decrypted fields
     */
    private function decryptSensitiveData($data)
    {
        // Define which fields should be decrypted
        $sensitiveFields = [
            'client_name',
            'client_number',
            'client_email',
            'client_address',
            'notes',
            'case_number'
            
        ];

        // Handle both objects and arrays
        if (is_object($data)) {
            foreach ($sensitiveFields as $field) {
                if (isset($data->$field) && !empty($data->$field)) {
                    $data->$field = $this->decrypt($data->$field);
                }
            }
        } elseif (is_array($data)) {
            foreach ($sensitiveFields as $field) {
                if (isset($data[$field]) && !empty($data[$field])) {
                    $data[$field] = $this->decrypt($data[$field]);
                }
            }
        }

        return $data;
    }

    /**
     * Save a new case to the database.
     *
     * @param array $data Associative array containing case details.
     * @return bool True if the operation was successful, false otherwise.
     */
    public function save($data)
    {
        // Encrypt sensitive data before saving
        $encryptedData = $this->encryptSensitiveData($data);

        // Prepare the query to insert data into the "cases" table
        $query = "INSERT INTO {$this->table} 
                  (client_id, client_registered, client_name, client_number, client_email, client_address, 
                   case_number, court, notes, attorney_id, junior_id, case_status)
                  VALUES 
                  (:client_id, :client_registered, :client_name, :client_number, :client_email, :client_address, 
                   :case_number, :court, :notes, :attorney_id, :junior_id, :case_status)";

        // Bind parameters to prevent SQL injection
        $params = [
            'client_id' => $encryptedData['client_id'] ?? null,
            'client_registered' => $encryptedData['client_registered'] ?? 0,
            'client_name' => $encryptedData['client_name'],
            'client_number' => $encryptedData['client_number'],
            'client_email' => $encryptedData['client_email'],
            'client_address' => $encryptedData['client_address'],
            'case_number' => $encryptedData['case_number'],
            'court' => $encryptedData['court'],
            'notes' => $encryptedData['notes'],
            'attorney_id' => $encryptedData['attorney_id'] ?? null,
            'junior_id' => $encryptedData['junior_id'] ?? null,
            'case_status' => $encryptedData['case_status'] ?? 'Active'
        ];

        // Execute the query using the parent Model class's query method
        return $this->query($query, $params);
    }


    /**
     * Retrieve all non-deleted cases from the database.
     * @return array Array of case objects.
     * 
     */
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

        $cases = $this->query($query);

        // Decrypt sensitive data in each case
        if (is_array($cases)) {
            foreach ($cases as &$case) {
                $case = $this->decryptSensitiveData($case);
            }
        }

        return $cases;
    }

    /**
     * Retrieve a specific case by its ID.
     * @param int $id Case ID.
     * @return object|null Case object or null if not found.
     */
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

        // Decrypt sensitive data
        $case = $this->decryptSensitiveData($result[0]);

        return $case; // Return the first (and expected only) result
    }

    /**
     * Soft delete a case (mark as deleted instead of removing from database)
     * @param int $caseId Case ID.
     * @return bool True if the operation was successful, false otherwise.
     */
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

        $cases = $this->query($query);

        // Decrypt sensitive data in each case
        if (is_array($cases)) {
            foreach ($cases as &$case) {
                $case = $this->decryptSensitiveData($case);
            }
        }

        return $cases;
    }

    // Optional: Restore a deleted case
    public function restoreCase($caseId)
    {
        $query = "UPDATE {$this->table} SET deleted = 0, updated_at = NOW() WHERE id = :id";
        $params = ['id' => $caseId];
        return $this->query($query, $params);
    }

    /**
     * Update an existing case in the database.
     *
     * @param array $data Associative array containing case details.
     * @return bool True if the operation was successful, false otherwise.
     */
    public function updateCase($data)
    {
        // Encrypt sensitive data before updating
        $encryptedData = $this->encryptSensitiveData($data);

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
            'id' => $encryptedData['id'],
            'client_id' => $encryptedData['client_id'] ?? null,
            'client_registered' => $encryptedData['client_registered'] ?? 0,
            'client_name' => $encryptedData['client_name'],
            'client_number' => $encryptedData['client_number'],
            'client_email' => $encryptedData['client_email'],
            'client_address' => $encryptedData['client_address'],
            'case_number' => $encryptedData['case_number'],
            'court' => $encryptedData['court'],
            'notes' => $encryptedData['notes'],
            'attorney_id' => $encryptedData['attorney_id'] ?? null,
            'junior_id' => $encryptedData['junior_id'] ?? null,
            'case_status' => $encryptedData['case_status'] ?? 'Active'
        ];

        return $this->query($query, $params);
    }

    /**
     * get case number by client email(used in payments page)
     * @param string $email Client email.
     * @return string|null Case number or null if not found.
     */
    public function getCaseNumberByEmail($email)
    {
        // Since email is encrypted, we need to get all cases and filter
        $allCases = $this->getAllCases();

        foreach ($allCases as $case) {
            if ($case->client_email === $email) {
                return $case->case_number;
            }
        }

        return null;
    }

    /**
     * get case number by client email(used in payments page)
     * @param string $email Client email.
     * @return array Array of cases matching the email.
     */
    public function getCasesByClientEmail($email)
    {
        // Since email is encrypted, we need to get all cases and filter
        $allCases = $this->getAllCases();
        $matchingCases = [];

        foreach ($allCases as $case) {
            if ($case->client_email === $email) {
                $matchingCases[] = $case;
            }
        }

        return $matchingCases;
    }

    /**
     * Get all cases for a specific client.
     * @param int $clientId Client ID.
     * @return array Array of case objects for the client.
     */
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

        $cases = $this->query($query, $params);

        // Decrypt sensitive data in each case
        if (is_array($cases)) {
            foreach ($cases as &$case) {
                $case = $this->decryptSensitiveData($case);
            }
        }

        return $cases;
    }

    // Get cases by attorney ID
    public function getCasesByAttorneyId($attorneyId)
    {
        $query = "SELECT * FROM {$this->table} WHERE attorney_id = :attorney_id AND deleted = 0";
        $params = ['attorney_id' => $attorneyId];

        $cases = $this->query($query, $params);

        // Decrypt sensitive data in each case
        if (is_array($cases)) {
            foreach ($cases as &$case) {
                $case = $this->decryptSensitiveData($case);
            }
        }

        return $cases;
    }

    // Get cases by junior ID
    public function getCasesByJuniorId($juniorId)
    {
        #get only not deleted cases
        $query = "SELECT * FROM {$this->table} WHERE junior_id = :junior_id AND deleted = 0";
        $params = ['junior_id' => $juniorId];

        $cases = $this->query($query, $params);

        
        if (is_array($cases)) {
            foreach ($cases as &$case) {
                $case = $this->decryptSensitiveData($case);
            }
        }

        return $cases;
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
    public function searchCases($searchQuery, $field = 'all')
    {
        // Since we're using encryption, we need to handle search differently
        // First, get all non-deleted cases
        $query = "SELECT c.*, 
              a.first_name as attorney_first_name, a.last_name as attorney_last_name,
              j.first_name as junior_first_name, j.last_name as junior_last_name
              FROM {$this->table} c
              LEFT JOIN users a ON c.attorney_id = a.id
              LEFT JOIN users j ON c.junior_id = j.id
              WHERE c.deleted = 0";

        $allCases = $this->query($query);

        // Decrypt all cases
        if (is_array($allCases)) {
            foreach ($allCases as &$case) {
                $case = $this->decryptSensitiveData($case);
            }
        } else {
            return []; // No cases found
        }

        // Now filter the decrypted cases based on search criteria
        $searchQuery = strtolower($searchQuery); // Case-insensitive search
        $results = [];

        foreach ($allCases as $case) {
            // Search in specific field or all fields
            if ($field === 'all') {
                // Search in all relevant fields
                if (
                    (isset($case->case_number) && stripos($case->case_number, $searchQuery) !== false) ||
                    (isset($case->client_name) && stripos($case->client_name, $searchQuery) !== false) ||
                    (isset($case->client_email) && stripos($case->client_email, $searchQuery) !== false) ||
                    (isset($case->client_number) && stripos($case->client_number, $searchQuery) !== false) ||
                    (isset($case->court) && stripos($case->court, $searchQuery) !== false) ||
                    (isset($case->notes) && stripos($case->notes, $searchQuery) !== false)
                ) {
                    $results[] = $case;
                }
            } else {
                // Search in specific field
                if (isset($case->$field) && stripos($case->$field, $searchQuery) !== false) {
                    $results[] = $case;
                }
            }
        }

        return $results;
    }

    //get a count of ongoing cases
    public function getOngoingCasesCount(){
        $query="SELECT COUNT(id) FROM {$this->table} WHERE deleted=0 AND case_status='ongoing'";
    }
}
