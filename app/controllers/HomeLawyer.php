<?php

// HomeLawyer class
class HomeLawyer
{
    use Controller;

    public function __construct()
    {
        // Require login for all methods in this controller
        $this->requireLogin();
        $this->requireRole(['lawyer']);
    }

    public function index()
    {
        // Set username from session, or default to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $caseModel = $this->loadModel('CaseModel');
        $paymentModel = $this->loadModel('PaymentModel');
        $userModel = $this->loadModel('UserModel');

        // Get basic statistics
        $ongoingCasesCount = $caseModel->getOngoingCasesCount();
        $totalAmount = $paymentModel->getTotalAmountReceivedInMonth();
        $delayedCases = $caseModel->getDelayedCases();

        // Fix: Check if $delayedCases is an array before counting
        $delayedCasesCount = is_array($delayedCases) ? count($delayedCases) : 0;

        // Get case status distribution for pie chart
        // Add these methods to CaseModel if they don't exist
        $activeCases = method_exists($caseModel, 'getCaseCountByStatus') ?
            $caseModel->getCaseCountByStatus('Ongoing') : 0;
        $closedCases = method_exists($caseModel, 'getCaseCountByStatus') ?
            $caseModel->getCaseCountByStatus('Closed') : 0;

        // Get attorneys and their case counts
        $attorneys = $userModel->getUsersByRole('attorney');
        $attorneyCaseCounts = [];
        $attorneyNames = [];

        if (is_array($attorneys)) {
            foreach ($attorneys as $attorney) {
                $attorneyNames[] = $attorney->first_name . ' ' . $attorney->last_name;
                $attorneyCaseCounts[] = count($caseModel->getCasesByAttorneyId($attorney->id));
            }
        }

        // Get juniors and their case counts
        $juniors = $userModel->getUsersByRole('junior');
        $juniorCaseCounts = [];
        $juniorNames = [];

        if (is_array($juniors)) {
            foreach ($juniors as $junior) {
                $juniorNames[] = $junior->first_name . ' ' . $junior->last_name;
                $juniorCaseCounts[] = count($caseModel->getCasesByJuniorId($junior->id));
            }
        }

        // Get cases closed over time (last 6 months)
        $monthLabels = [];
        $casesClosedData = [];

        // Only add this if the method exists in CaseModel
        if (method_exists($caseModel, 'getClosedCasesCountByMonth')) {
            for ($i = 5; $i >= 0; $i--) {
                $month = date('F', strtotime("-$i months"));
                $monthLabels[] = $month;
                $casesClosedData[] = $caseModel->getClosedCasesCountByMonth(date('Y-m', strtotime("-$i months")));
            }
        } else {
            // Fallback data if method doesn't exist
            $monthLabels = ['January', 'February', 'March', 'April', 'May', 'June'];
            $casesClosedData = [0, 0, 0, 0, 0, 0];
        }

        // Get recent cases (limit to 5)
        $recentCases = method_exists($caseModel, 'getRecentCases') ?
            $caseModel->getRecentCases(5) : [];

        // Load the view with data
        $this->view('/seniorCounsel/home', [
            'ongoingCasesCount' => $ongoingCasesCount,
            'totalAmount' => $totalAmount,
            'delayedCases' => $delayedCasesCount,
            'recentCases' => $recentCases,

            // Chart data
            'pieChartData' => [
                'labels' => ['Ongoing', 'Delayed', 'Closed'],
                'data' => [$activeCases, $delayedCasesCount, $closedCases]
            ],
            'attorneyChartData' => [
                'labels' => $attorneyNames,
                'data' => $attorneyCaseCounts
            ],
            'juniorChartData' => [
                'labels' => $juniorNames,
                'data' => $juniorCaseCounts
            ],
            'lineChartData' => [
                'labels' => $monthLabels,
                'data' => $casesClosedData
            ]
        ]);
    }
}
