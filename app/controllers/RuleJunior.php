<?php

// HomeAdmin class
class RuleJunior
{
    use Controller;

    public function index()
    {

        // Set username from session, or default to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        // Load the view with data
        $this->view('/juniorcounsel/rule', $data);
    }
}
