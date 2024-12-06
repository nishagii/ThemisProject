<?php

class Admin
{
    use Controller;

    public function index()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // echo "POST received"; // Debug point 1
            // var_dump($_POST);
            // die();
            $user = $this->loadModel('UserModel');

            // Validate other input fields
            if (empty($data['errors']) && $user->validate($_POST)) {
                // Save user with the specified role
                if ($user->save($_POST)) {
                    redirect('homeadmin'); // Redirect to admin user management page
                    return;
                } else {
                    $data['errors'][] = "Unable to save user to the database.";
                }
            } else {
                $data['errors'] = $user->errors;
            }
        }

        // Load the add user view for admins
        $this->view('admin/add_user', $data);
    }
}
