<?php

class NotificationController
{
    use Controller;

    public function getUnreadNotifications()
    {
        // Check if user is logged in
        if (empty($_SESSION['user_id'])) {
            echo json_encode([]);
            return;
        }

        $userId = $_SESSION['user_id'];
        $notificationModel = $this->loadModel('NotificationModel');
        $notifications = $notificationModel->getUnreadNotificationsByUserId($userId);
        
        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode($notifications);
    }
    
    public function markAsRead($id = null)
    {
        if (empty($_SESSION['user_id']) || $id === null) {
            echo json_encode(['success' => false]);
            return;
        }
        
        $notificationModel = $this->loadModel('NotificationModel');
        $success = $notificationModel->markAsRead($id);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
}