<?php

class CaseJunior
{

    use Controller;

    public function index()
    {
        // Render the "add new case" view with an empty errors array
        $this->view('/juniorCounsel/case');
    }

}