<?php

//Users class 

class Users
{
    use Controller;

    public function index()
    {
        $this->view('/seniorCounsel/system_users');
    }
}
