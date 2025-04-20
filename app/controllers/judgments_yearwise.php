<?php

include __DIR__ . '/../views/all_precidents.view.php';
require '../models/judgments_yearwise.php';

class judgmentsYearwise{
    public function index()
    {
        $judgmentModel = new JudgmentsYearwiseModel();
        $judgments = $judgmentModel->getAllJudgments();

        include '../views/all_precidents.view.php';
    }
}

$judgmentsYearwise = new judgmentsYearwise();
$judgmentsYearwise->index();
?>
