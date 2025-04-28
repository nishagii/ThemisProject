<?php

class CaseModel
{
    use Model;
    protected $table = 'cases'; 
    private $encryptionKey; 
    private $encryptionMethod = 'AES-256-CBC'; 

    public function __construct()
    {
      
        $this->encryptionKey = getenv('ENCRYPTION_KEY');

        
        if (!$this->encryptionKey) {
            $this->encryptionKey = 'ladiesandgentelements@themis2025@ucscweareencryptednow'; 
            error_log("Warning: Using fallback encryption key. Set ENCRYPTION_KEY in environment for security.");
        }
    }

    
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

 
        return base64_encode($iv . base64_decode($encrypted));
    }

   
    private function decrypt($data)
    {
        if (empty($data)) return $data;

        try {
            $data = base64_decode($data);
            $ivLength = openssl_cipher_iv_length($this->encryptionMethod);

            
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
            
            error_log("Decryption error: " . $e->getMessage());
            return "Error: Could not decrypt data";
        }
    }

    
    private function encryptSensitiveData($data)
    {

        $sensitiveFields = [
            'client_name',
            'client_number',
            'client_email',
            'client_address',
            'notes'
        ];

        foreach ($sensitiveFields as $field) {
            if (isset($data[$field]) && !empty($data[$field])) {
                $data[$field] = $this->encrypt($data[$field]);
            }
        }

        return $data;
    }


    public function decryptSensitiveData($data)
    {
        
        $sensitiveFields = [
            'client_name',
            'client_number',
            'client_email',
            'client_address',
            'notes'

        ];

     
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

    public function save($data)
    {
        
        $encryptedData = $this->encryptSensitiveData($data);

       
        $query = "INSERT INTO {$this->table} 
                  (client_id, client_registered, client_name, client_number, client_email, client_address, 
                   case_number, court, notes, attorney_id, junior_id, case_status)
                  VALUES 
                  (:client_id, :client_registered, :client_name, :client_number, :client_email, :client_address, 
                   :case_number, :court, :notes, :attorney_id, :junior_id, :case_status)";

        
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

        
        return $this->query($query, $params);
    }



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

  
        if (is_array($cases)) {
            foreach ($cases as &$case) {
                $case = $this->decryptSensitiveData($case);
            }
        }

        return $cases;
    }

    
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

      
        if (empty($result)) {
            return null; 
        }

      
        $case = $this->decryptSensitiveData($result[0]);

        return $case; 
    }

   
    public function softDeleteCase($caseId)
    {
        $query = "UPDATE {$this->table} SET deleted = 1, updated_at = NOW() WHERE id = :id";
        $params = ['id' => $caseId];
        return $this->query($query, $params);
    }


 
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

    
        if (is_array($cases)) {
            foreach ($cases as &$case) {
                $case = $this->decryptSensitiveData($case);
            }
        }

        return $cases;
    }

  
    public function restoreCase($caseId)
    {
        $query = "UPDATE {$this->table} SET deleted = 0, updated_at = NOW() WHERE id = :id";
        $params = ['id' => $caseId];
        return $this->query($query, $params);
    }

    public function updateCase($data)
    {
        
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

    
    public function getCaseNumberByEmail($email)
    {
        
        $allCases = $this->getAllCases();

        foreach ($allCases as $case) {
            if ($case->client_email === $email) {
                return $case->case_number;
            }
        }

        return null;
    }

   
    public function getCasesByClientEmail($email)
    {
      
        $allCases = $this->getAllCases();
        $matchingCases = [];

        foreach ($allCases as $case) {
            if ($case->client_email === $email) {
                $matchingCases[] = $case;
            }
        }

        return $matchingCases;
    }

  
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

       
        if (is_array($cases)) {
            foreach ($cases as &$case) {
                $case = $this->decryptSensitiveData($case);
            }
        }

        return $cases;
    }

   
    public function getCasesByAttorneyId($attorneyId)
    {
        $query = "SELECT * FROM {$this->table} WHERE attorney_id = :attorney_id AND deleted = 0";
        $params = ['attorney_id' => $attorneyId];

        $cases = $this->query($query, $params);

      
        if (is_array($cases)) {
            foreach ($cases as &$case) {
                $case = $this->decryptSensitiveData($case);
            }
        }

        return $cases;
    }

    
    public function getCasesByJuniorId($juniorId)
    {
      
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

    
    public function searchCases($searchQuery, $field = 'all')
    {
        
        $query = "SELECT c.*, 
              a.first_name as attorney_first_name, a.last_name as attorney_last_name,
              j.first_name as junior_first_name, j.last_name as junior_last_name
              FROM {$this->table} c
              LEFT JOIN users a ON c.attorney_id = a.id
              LEFT JOIN users j ON c.junior_id = j.id
              WHERE c.deleted = 0";

        $allCases = $this->query($query);

       
        if (is_array($allCases)) {
            foreach ($allCases as &$case) {
                $case = $this->decryptSensitiveData($case);
            }
        } else {
            return []; 
        }

  
        $searchQuery = strtolower($searchQuery); 
        $results = [];

        foreach ($allCases as $case) {
           
            if ($field === 'all') {
               
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
               
                if (isset($case->$field) && stripos($case->$field, $searchQuery) !== false) {
                    $results[] = $case;
                }
            }
        }

        return $results;
    }


   
    public function getOngoingCasesCount()
    {
        $query = "SELECT COUNT(*) as count FROM {$this->table} WHERE case_status = 'ongoing'
                  AND deleted = 0";

        $result = $this->query($query);

       
        if (!empty($result)) {
          
            return $result[0]->count;
        }

        return 0; 
    }


    public function getDelayedCases()
    {
      
        $twoMonthsAgo = date('Y-m-d', strtotime('-2 months'));

        $query = "SELECT * FROM {$this->table} 
              WHERE updated_at < :two_months_ago";

        $params = ['two_months_ago' => $twoMonthsAgo];

        return $this->query($query, $params);
    }

  
    public function getJuniorCaseCounts()
    {
        $query = "SELECT junior_id, COUNT(*) as case_count 
              FROM {$this->table} 
              WHERE deleted = 0 AND junior_id IS NOT NULL 
              GROUP BY junior_id";

        $results = $this->query($query);

        $caseCounts = [];
        if (is_array($results)) {
            foreach ($results as $row) {
                $caseCounts[$row->junior_id] = $row->case_count;
            }
        }

        return $caseCounts;
    }


    public function getJuniorWithLowestCaseLoad($juniors)
    {
        if (empty($juniors)) {
            return null;
        }

        $caseCounts = $this->getJuniorCaseCounts();

        $lowestCount = PHP_INT_MAX;
        $selectedJuniorId = null;

        foreach ($juniors as $junior) {
            $count = $caseCounts[$junior->id] ?? 0; 

            if ($count < $lowestCount) {
                $lowestCount = $count;
                $selectedJuniorId = $junior->id;
            }
        }

        return $selectedJuniorId;
    }

    public function getCaseCountByStatus($status)
    {
        $query = "SELECT COUNT(*) as count FROM {$this->table} 
              WHERE case_status = :status AND deleted = 0";
        $params = ['status' => $status];

        $result = $this->query($query, $params);

      
        if (!empty($result)) {
            return $result[0]->count;
        }

        return 0; 
    }

  
    public function getClosedCasesCountByMonth($yearMonth)
    {
        $query = "SELECT COUNT(*) as count FROM {$this->table} 
              WHERE case_status = 'Closed' 
              AND DATE_FORMAT(updated_at, '%Y-%m') = :year_month
              AND deleted = 0";
        $params = ['year_month' => $yearMonth];

        $result = $this->query($query, $params);

        if (!empty($result)) {
            return $result[0]->count;
        }

        return 0;
    }


    public function getRecentCases($limit = 5)
    {
       
        $limit = (int)$limit;

        $query = "SELECT c.*, 
              a.first_name as attorney_first_name, a.last_name as attorney_last_name,
              j.first_name as junior_first_name, j.last_name as junior_last_name
              FROM {$this->table} c
              LEFT JOIN users a ON c.attorney_id = a.id
              LEFT JOIN users j ON c.junior_id = j.id
              WHERE c.deleted = 0
              ORDER BY c.created_at DESC
              LIMIT $limit";  

      
        $cases = $this->query($query);

       
        if (is_array($cases)) {
            foreach ($cases as &$case) {
                $case = $this->decryptSensitiveData($case);
            }
        }

        return $cases;
    }
}
