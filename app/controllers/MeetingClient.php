<?php

class MeetingClient
{
    use Controller;

    public function index()
    {
        $meetingModel = $this->loadModel('MeetingModel');
        $meetings = $meetingModel->getMeetingsByClientId($_SESSION['user_id']); 

        // Pass meeting history to the view
        $this->view('client/meeting', ['meetings' => $meetings]);
    }

    // Handle the submission of the meeting request form

    public function requestMeeting()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'client_id' => $_SESSION['user_id']??'',
                'meeting_date' => $_POST['meeting_date'] ?? '',
                'meeting_time' => $_POST['meeting_time'] ?? '',
                'meeting_purpose' => $_POST['meeting_purpose']?? '',
                'meeting_comments' => $_POST['meeting_comments']?? '',
                'meeting_status' => 'Pending',
                'meeting_location' => $_POST['meeting_location'] ?? ''
            ];

            $meetingModel = $this->loadModel('MeetingModel');

            if ($meetingModel->createMeeting($data)) {
                $_SESSION['success'] = "Meeting request submitted successfully!";
            } else {
                $_SESSION['error'] = "Failed to submit meeting request. Please try again.";
            }

            redirect('meetingclient');
            exit;
        }
    }

    public function deleteMeeting($meetingId)
    {
        // Check if the meeting exists and belongs to the current user
        $meetingModel = $this->loadModel('MeetingModel');
        $meeting = $meetingModel->getMeetingById($meetingId);

        if (!$meeting || $meeting->client_id != $_SESSION['user_id']) {
            $_SESSION['error'] = "Meeting not found or you don't have permission to delete it.";
            redirect('meetingclient');
            return;
        }

        // Check if the meeting is in 'Pending' status
        if ($meeting->meeting_status !== 'Pending') {
            $_SESSION['error'] = "Only pending meetings can be deleted.";
            redirect('meetingclient');
            return;
        }

        // Delete the meeting
        if ($meetingModel->deleteMeeting($meetingId)) {
            $_SESSION['success'] = "Meeting request deleted successfully!";
        } else {
            $_SESSION['error'] = "Failed to delete meeting request. Please try again.";
        }

        redirect('meetingclient');
    }
}
