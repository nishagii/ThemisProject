<?php

class FeedbackModel
{
    use Model;
    protected $table = 'feedback';

    /**
     * Save a new feedback to the database.
     *
     * @param array $data Associative array containing feedback details.
     * @return bool True if the operation was successful, false otherwise.
     */
    public function save($data) {
        $query = "INSERT INTO {$this->table} (user_id, rating, description, created_at) VALUES (:user_id, :rating, :description, NOW())";
        
        // Prepare the parameters
        $params = [
            
            'user_id' => $data['user_id'],
            'rating' => $data['rating'],
            'description' => $data['description']
        ];
        
        // Execute the query and check for success
        return $this->query($query, $params);
    }

    /**
     * Get all feedback entries
     * 
     * @return array Array of feedback records
     */
    public function getAllFeedback()
    {
        $query = "SELECT f.*, u.first_name, u.last_name FROM {$this->table} f 
                  JOIN users u ON f.user_id = u.id 
                  ORDER BY f.created_at DESC";
        return $this->query($query);
    }

    /**
     * Get feedback by user ID
     * 
     * @param int $userId The user ID
     * @return array Array of feedback records for this user
     */
    public function getFeedbackByUserId($userId)
    {
        $query = "SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY created_at DESC";
        $params = ['user_id' => $userId];
        return $this->query($query, $params);
    }

    /**
     * Get a specific feedback by ID
     * 
     * @param int $id Feedback ID
     * @return object|null The feedback record or null if not found
     */
    public function getFeedbackById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $params = ['id' => $id];
        
        $result = $this->query($query, $params);
        return empty($result) ? null : $result[0];
    }

    /**
     * Update an existing feedback
     * 
     * @param array $data Associative array containing feedback details
     * @return bool True if the operation was successful, false otherwise
     */
    public function updateFeedback($data)
    {
        $query = "UPDATE {$this->table} 
                  SET 
                      rating = :rating,
                      description = :description,
                      updated_at = NOW()
                  WHERE id = :id AND user_id = :user_id";
        
        $params = [
            'rating' => $data['rating'],
            'description' => $data['description'],
            'id' => $data['id'],
            'user_id' => $data['user_id']
        ];
        
        return $this->query($query, $params);
    }

    /**
     * Delete a feedback by ID
     * 
     * @param int $id Feedback ID
     * @return bool True if the operation was successful, false otherwise
     */
    public function deleteFeedback($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $params = ['id' => $id];
        return $this->query($query, $params);
    }
}
