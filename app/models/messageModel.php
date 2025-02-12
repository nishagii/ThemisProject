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

    public function getMessagesByMsgId($msgid)
{
    try {
        $query = "SELECT * FROM {$this->table} 
                  WHERE msgid = :msgid
                  ORDER BY date ASC"; // Optional: you can order by date or message ID
        
        $params = [
            ':msgid' => $msgid
        ];

        $result = $this->query($query, $params);

        if (!$result) {
            error_log("No messages found with msgid {$msgid}");
        }

        return $result;
    } catch (Exception $e) {
        error_log("Error retrieving messages by msgid: " . $e->getMessage());
        return false;
    }
}

}
