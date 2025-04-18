<?php

// Users class 

class Users
{
    use Controller;

    public function index()
    {
        $userModel = $this->loadModel('UserModel');

        $clients = $userModel->getUsersByRole('client');
        $attorneys = $userModel->getUsersByRole('attorney');
        $juniors = $userModel->getUsersByRole('junior');

        $data = [
            'clients' => $clients,
            'attorneys' => $attorneys,
            'juniors' => $juniors
        ];

        $this->view('/seniorCounsel/system_users', $data);
    }
}
