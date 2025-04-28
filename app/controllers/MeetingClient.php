<?php

class MeetingClient
{
    use Controller;

    public function index()
    {
        $meetingModel = $this->loadModel('MeetingModel');
        $meetings = $meetingModel->getMeetingsByClientId($_SESSION['user_id']); 

       
        $this->view('client/meeting', ['meetings' => $meetings]);
    }

    

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
        
        $meetingModel = $this->loadModel('MeetingModel');
        $meeting = $meetingModel->getMeetingById($meetingId);

        if (!$meeting || $meeting->client_id != $_SESSION['user_id']) {
            $_SESSION['error'] = "Meeting not found or you don't have permission to delete it.";
            redirect('meetingclient');
            return;
        }

        
        if ($meeting->meeting_status !== 'Pending') {
            $_SESSION['error'] = "Only pending meetings can be deleted.";
            redirect('meetingclient');
            return;
        }

        
        if ($meetingModel->deleteMeeting($meetingId)) {
            $_SESSION['success'] = "Meeting request deleted successfully!";
        } else {
            $_SESSION['error'] = "Failed to delete meeting request. Please try again.";
        }

        redirect('meetingclient');
    }
}
