<?php

class messageModel
{
    use Model;
    protected $table = 'messages'; // Name of the database table

    /**
     * Save a new message to the database.
     *
     * @param array $data Associative array containing message details.
     * @return bool True if the operation was successful, false otherwise.
     */
    public function save($data)
    {
        // Prepare the query to insert data into the "messages" table
        $query = "INSERT INTO {$this->table} 
                  (msgid, sender, receiver, message, files, seen, received, deleted_sender, deleted_receiver, date)
                  VALUES 
                  (:msgid, :sender, :receiver, :message, :files, :seen, :received, :deleted_sender, :deleted_receiver, :date)";

        // Bind parameters to prevent SQL injection
        $params = [
            'msgid' => $data['msgid'],
            'sender' => $data['sender'],
            'receiver' => $data['receiver'],
            'message' => $data['message'],
            'files' => $data['files'] ?? null,
            'seen' => $data['seen'] ?? 0,
            'received' => $data['received'] ?? 0,
            'deleted_sender' => $data['deleted_sender'] ?? 0,
            'deleted_receiver' => $data['deleted_receiver'] ?? 0,
            'date' => $data['date'],
        ];

        // Execute the query using the parent Model class's query method
        return $this->query($query, $params);
    }

   
}
