<?php

// Users class 
class Users
{
    use Controller;

    public function index()
    {
        $userModel = $this->loadModel('UserModel');
        $caseModel = $this->loadModel('CaseModel');

        $clients = $userModel->getUsersByRole('client');
        $attorneys = $userModel->getUsersByRole('attorney');
        $juniors = $userModel->getUsersByRole('junior');

        // Get cases for each client
        foreach ($clients as $client) {
            $client->cases = $caseModel->getCasesByClientEmail($client->email);
        }

        $data = [
            'clients' => $clients,
            'attorneys' => $attorneys,
            'juniors' => $juniors
        ];

        $this->view('/seniorCounsel/system_users', $data);
    }

}
