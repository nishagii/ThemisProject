<?php

class CaseClient
{
    use Controller;

    public function index()
    {

        

        // Load the view with data
        $this->view('/client/case');
    }
}
