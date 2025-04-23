<?php

class DocumentModel {
    use Model;
    
    protected $table = 'documents'; 
    
    /**
     * Save a new document to the database.
     *
     * @param array $data Associative array containing document details.
     * @return bool True if the operation was successful, false otherwise.
     */
    public function save($data)
    {
        try {
            // Prepare the query
            $query = "INSERT INTO {$this->table}
                     (case_id, doc_name, doc_description, file_path, uploaded_by)
                     VALUES
                     (:case_id, :doc_name, :doc_description, :file_path, :uploaded_by)";
            
            // Bind parameters
            $params = [
                'case_id' => $data['case_id'],
                'doc_name' => $data['doc_name'],
                'doc_description' => $data['doc_description'],
                'file_path' => $data['file_path'],
                'uploaded_by' => $data['uploaded_by'],
            ];
            
            // Debug: Print the query and parameters
            // echo "Query: $query"; echo "<pre>"; print_r($params); echo "</pre>"; exit;
            
            // Execute the query
            $result = $this->query($query, $params);
            return $result;
        } catch (Exception $e) {
            // Log the error for debugging
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Get all documents for a specific case.
     *
     * @param int $case_id The case ID to fetch documents for.
     * @return array List of documents associated with the case.
     */
    public function getDocumentsByCase($case_id)
    {
        $query = "SELECT d.*, users.first_name AS first_name FROM {$this->table} d INNER JOIN users ON d.uploaded_by = users.id WHERE case_id = :case_id ORDER BY document_id DESC";
        $params = ['case_id' => $case_id];
        
        // Execute the query and return the result
        return $this->query($query, $params);
    }
    
    /**
     * Get document details by document ID.
     *
     * @param int $document_id The ID of the document.
     * @return array The document details.
     */
    public function getDocumentById($document_id)
    {
        $query = "SELECT * FROM {$this->table} WHERE document_id = :document_id";
        $params = ['document_id' => $document_id];
        
        // Execute the query and return the result
        return $this->query($query, $params);
    }
    
    /**
     * Update an existing document in the database.
     *
     * @param array $data Associative array containing document details to update.
     * @param int $document_id The ID of the document to update.
     * @return bool True if the operation was successful, false otherwise.
     */
    public function update($data, $document_id)
    {
        try {
            // Build the SET part of the query dynamically based on provided data
            $setClause = [];
            $params = ['document_id' => $document_id];
            
            // Only include fields that are provided in the data array
            if (isset($data['doc_name'])) {
                $setClause[] = "doc_name = :doc_name";
                $params['doc_name'] = $data['doc_name'];
            }
            
            if (isset($data['doc_description'])) {
                $setClause[] = "doc_description = :doc_description";
                $params['doc_description'] = $data['doc_description'];
            }
            
            if (isset($data['file_path'])) {
                $setClause[] = "file_path = :file_path";
                $params['file_path'] = $data['file_path'];
            }
            
            // If no fields to update, return true (no changes needed)
            if (empty($setClause)) {
                return true;
            }
            
            // Prepare the query with the constructed SET clause
            $query = "UPDATE {$this->table} SET " . implode(', ', $setClause) . 
                     " WHERE document_id = :document_id";
            
            // Execute the query
            $result = $this->query($query, $params);
            return $result;
        } catch (Exception $e) {
            // Log the error for debugging
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Delete a document from the database.
     *
     * @param int $document_id The ID of the document to delete.
     * @return bool True if the operation was successful, false otherwise.
     */
    public function delete($document_id)
    {
        try {
            // Prepare the query
            $query = "DELETE FROM {$this->table} WHERE document_id = :document_id";
            
            // Bind parameters
            $params = ['document_id' => $document_id];
            
            // Execute the query
            $result = $this->query($query, $params);
            return $result;
        } catch (Exception $e) {
            // Log the error for debugging
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }
}