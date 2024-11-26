<?php

class MeetingClient
{
    use Controller;

    public function index()
    {

        

        // Load the view with data
        $this->view('/client/meeting');
    }
}
