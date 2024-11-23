<?php

class ClientProfile
{
    use Controller;

    public function index()
    {

        // Set username from session, or default to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        // Load the view with data
        $this->view('/client/component/bigNav', $data);
        $this->view('/client/component/smallNav1', $data);
        $this->view('profileComponent', $data);
    }
}
