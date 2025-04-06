<?php

class NotificationModel 
{
    use Model;
    protected $table = 'notifications';

    public function createNotification($data)
    {
        $query = "INSERT INTO {$this->table} (user_id, message, timestamp, status) 
                  VALUES (:user_id, :message, :timestamp, :status)";
        return $this->query($query, $data);
    }

    public function getNotificationsByUserId($userId)
    {
        $query = "SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY timestamp DESC";
        return $this->query($query, ['user_id' => $userId]);
    }

    public function getUnreadNotificationsByUserId($userId)
    {
        $query = "SELECT * FROM {$this->table} WHERE user_id = :user_id AND status = 'unread' ORDER BY timestamp DESC";
        return $this->query($query, ['user_id' => $userId]);
    }

    public function markAsRead($id)
    {
        $query = "UPDATE {$this->table} SET status = 'read' WHERE id = :id";
        return $this->query($query, ['id' => $id]);
    }
}