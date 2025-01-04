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
}
