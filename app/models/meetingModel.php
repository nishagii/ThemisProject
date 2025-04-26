<?php

class MeetingModel
{
    use Model;
    protected $table = 'meetings';

    public function createMeeting($data)
    {
       

        $query = "INSERT INTO {$this->table}
        (client_id,meeting_date, meeting_time, meeting_purpose, meeting_comments,meeting_status)
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
    public function getAllMeetings()
    {
        $query = "SELECT m.*, u.first_name, u.last_name,u.phone
              FROM {$this->table} m
              INNER JOIN users u ON m.client_id = u.id
            --   WHERE m.meeting_date > CURDATE() 
            --   OR (m.meeting_date = CURDATE() AND m.meeting_time >= CURTIME()) 
              ORDER BY m.meeting_date ASC, m.meeting_time ASC";
        return $this->query($query);
    } // uncomment this condition after showing off your damn skills xD


    public function updateMeetingStatus($meetingId,$status)
    {
        $query = "UPDATE {$this->table} SET meeting_status = :meeting_status WHERE id = :id ";
        $params =[
            'id' => $meetingId,
            'meeting_status' => $status
        ];

        return $this->query($query,$params);
    }

    public function getMeetingById($meetingId)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $params = ['id' => $meetingId];
        $result = $this->query($query, $params);

        return !empty($result) ? $result[0] : null;
    }

    public function deleteMeeting($meetingId)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $params = ['id' => $meetingId];

        return $this->query($query, $params);
    }
}

