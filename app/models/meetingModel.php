<?php

class MeetingModel
{
    use Model;
    protected $table = 'meetings';

    public function createMeeting($data)
    {
       

        $query = "INSERT INTO {$this->table}
        (client_id,meeting_date, meeting_time, meeting_purpose, meeting_comments,status)
        VALUES
        (:client_id,:meeting_date, :meeting_time, :meeting_purpose, :meeting_comments, :meeting_status)";


        // Bind parameters to prevent SQL injection

        $params = [
            'client_id' => $data['client_id'],
            'meeting_date' => $data['meeting_date'],
            'meeting_time' => $data['meeting_time'],
            'meeting_purpose' => $data['meeting_purpose'],
            'meeting_comments' => $data['meeting_comments'],
            'meeting_status' => 'Pending',
        ];

        return $this->query($query,$params);
    }

    public function getMeetingsByClientId($clientId)
    {
        $query = "SELECT * FROM {$this->table} WHERE client_id = :client_id ORDER BY meeting_date DESC";
        $params = ['client_id' => $clientId];
        return $this->query($query, $params);
    }
}
