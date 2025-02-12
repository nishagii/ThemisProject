<?php

class messageModel {
    use Model;
    protected $table = 'messages';

    public function save($data)
    {
        try {
            $query = "INSERT INTO {$this->table} 
                    (msgid, sender, receiver, message, files, seen, received, deleted_sender, deleted_receiver, date)
                    VALUES 
                    (:msgid, :sender, :receiver, :message, :files, :seen, :received, :deleted_sender, :deleted_receiver, :date)";

            $result = $this->query($query, $data);
            
            if (!$result) {
                error_log("Failed to save message: " . print_r($data, true));
            }
            
            return $result;
        } catch (Exception $e) {
            error_log("Error saving message: " . $e->getMessage());
            error_log("Data: " . print_r($data, true));
            return false;
        }
    }
}