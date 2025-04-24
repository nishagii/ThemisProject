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
        // Load cases for each attorney
        foreach ($attorneys as &$attorney) {
            $attorney->cases = $caseModel->getCasesByAttorneyId($attorney->id);
        }

        // Load cases for each junior
        foreach ($juniors as &$junior) {
            $junior->cases = $caseModel->getCasesByJuniorId($junior->id);
        }
        $data = [
            'clients' => $clients,
            'attorneys' => $attorneys,
            'juniors' => $juniors
        ];

        $this->view('/seniorCounsel/system_users', $data);
    }

    // In app/controllers/Users.php
    public function getUserDetails($userId = null)
    {
        if (!$userId) {
            echo json_encode(['success' => false, 'message' => 'No user ID provided']);
            exit;
        }

        $userModel = $this->loadModel('UserModel');
        $user = $userModel->getUserByID($userId);

        if ($user) {
            echo json_encode(['success' => true, 'user' => $user]);
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found']);
        }
        exit;
    }

    public function getAttorneyCases($attorneyId)
    {
        $caseModel = $this->loadModel('CaseModel');
        $cases = $caseModel->getCasesByAttorneyId($attorneyId);

        echo json_encode(['success' => true, 'cases' => $cases]);
        exit;
    }

    public function getJuniorCases($juniorId)
    {
        $caseModel = $this->loadModel('CaseModel');
        $cases = $caseModel->getCasesByJuniorId($juniorId);

        echo json_encode(['success' => true, 'cases' => $cases]);
        exit;
    }
}
