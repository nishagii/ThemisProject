<?php


//lawyer meetings class
class MeetingsLawyer
{
    use Controller;

    public function index($meetingType = '')
    {
        $meetingModel = $this->loadModel('meetingModel');

        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
        $data['meetingDetails'] = $meetingModel->getAllMeetings();
         
        //get meeting details
        
        $meetingDetails = $meetingModel->getAllMeetings(); 

        switch ($meetingType) {
            case "attorney":
                $this->view('/seniorCounsel/attorney_meetings', $data);
                break;

            case "junior":
                $this->view('/seniorCounsel/junior_meetings', $data);
                break;
            case "client":
            default:
                $this->view('/seniorCounsel/client_meetings',$data);
                break;
        }
    }

    public function updateMeetingStatus()
    {
        $data = json_decode(file_get_contents('php://input'));

        if (!empty($data->meeting_id) && !empty($data->meeting_status)) {
            $meetingModel = $this->loadModel('meetingModel');
            $result = $meetingModel->updateMeetingStatus($data->meeting_id, $data->meeting_status);

            echo json_encode(['success' => $result]);
            return;
        }

        echo json_encode(['success' => false]);
    }
}
