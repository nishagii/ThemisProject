<?php

class Register
{
    use Controller;

    public function index()
    {
        $data = [];
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = $this->loadModel('UserModel');
            
            if ($user->validate($_POST)) {
                if ($user->save($_POST)) {
                    redirect('homelawyer');
                    return;
                } else {
                    $data['errors']['general'] = "Unable to save user to the database. Please try again.";
                }
            } else {
                $data['errors'] = $user->errors;
            }
        }
        
        $this->view('register', $data);
    }
}