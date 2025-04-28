<?php
    $notification = [
        'user_id' => $assignee,
        'message' => "Task '$name' has been assigned to you. Check your task board",
        'timestamp' => date('Y-m-d H:i:s'),
        'status' => 'unread',
        'task_id' => $taskModel->getLastInsertId(), // Add task ID reference
        'priority' => $data['priority'],
        'deadline' => $data['deadlineDate'] . ' ' . $data['deadlineTime'],
        'assigned_by' => $_SESSION['USER']->id, // Current user's ID
        'action_url' => 'taskjunior/details/' . $taskModel->getLastInsertId() // Direct link to task
    ];

// Create immediate notification
$notificationModel->createNotification([
    'user_id' => $assignee,
    'message' => "Task '$name' has been assigned to you. Check your task board",
    'timestamp' => date('Y-m-d H:i:s'),
    'status' => 'unread'
]);

// Schedule a reminder notification
$deadlineTimestamp = strtotime($data['deadlineDate'] . ' ' . $data['deadlineTime']);
$reminderTime = $deadlineTimestamp - (24 * 60 * 60); // 1 day before deadline
$notificationModel->scheduleNotification([
    'user_id' => $assignee,
    'message' => "Reminder: Task '$name' is due tomorrow!",
    'scheduled_time' => date('Y-m-d H:i:s', $reminderTime),
    'status' => 'scheduled'
]);

$notification = [
    'user_id' => $assignee,
    'message' => "Task '$name' has been assigned to you. Check your task board",
    'timestamp' => date('Y-m-d H:i:s'),
    'status' => 'unread',
    'expires_at' => date('Y-m-d H:i:s', strtotime('+7 days')) // Auto-expire old notifications
];


