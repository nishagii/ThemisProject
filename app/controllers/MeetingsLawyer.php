<?php


//lawyer meetings class
class MeetingsLawyer
{
    use Controller;

    public function index($meetingType = '')
    {
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        switch ($meetingType) {
            case "attorney":
                $this->view('/seniorCounsel/attorney_meetings', $data);
                break;

            case "junior":
                $this->view('/seniorCounsel/junior_meetings', $data);
                break;
            case "client":
            default:
                $this->view('/seniorCounsel/client_meetings', $data);
                break;
        }
    }
}
