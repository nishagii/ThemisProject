<?php

class RegisterUser
{
    use Controller;

    public function index()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // echo "POST received"; // Debug point 1
            $user = $this->loadModel('UserModel');

            if ($user->validate($_POST)) {
                echo "Validation passed"; // Debug point 2
                if ($user->save($_POST)) {
                    echo "Save successful"; // Debug point 3
                    redirect('homelawyer');
                    return;
                } else {
                    $data['errors'] = ["Unable to save user to the database."];
                }
            } else {
                $data['errors'] = $user->errors;
            }
        }

        $this->view('register', $data);
    }
}
