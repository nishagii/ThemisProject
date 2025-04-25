<?php
 var_dump($ongoingCasesCount);?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- this is imported to use icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/home.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>

    <h1 class="home-heading">
        Welcome Back <?= $_SESSION['username'] ?>!
    </h1>

    <div class="home-section">
        <!-- Recent Cases -->
        <div class="card recent-cases">
            <h3>Recent Cases</h3>
            <p>Recently added cases. Click
                <span style="color: #fa9800; font-weight: bold;"> View All cases </span> to view all cases.
            </p>
            <table>
                <thead>
                    <tr>
                        <th>Case ID</th>
                        <th>Client</th>
                        <th>Status</th>
                        <th>Next Hearing</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>John Doe</td>
                        <td>In Progress</td>
                        <td>2024-12-05</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Jane Smith</td>
                        <td>Delayed</td>
                        <td>2024-12-10</td>
                    </tr>
                </tbody>
            </table>
            <a href="<?= ROOT ?>/cases/retrieveAllCases" class="btn">View All Cases</a>
        </div>


        <!-- Add Case Section -->
        <div class="card">
            <h3>Add New Case</h3>
            <p>Start managing a
                <span style="color: #fa9800; font-weight: bold;">new case</span> by clicking the button below.
            </p>
            <a href="<?= ROOT ?>/cases" class="btn">Add Case</a>
        </div>

        <div class="cards-container">
            <div class="card cards">
                <i class="fas fa-balance-scale"></i>
                <p>you have</p>
                <!-- cases count passed from the controller as $casesCount -->
                <p><?=$ongoingCasesCount ?></p>
                <h3>Ongoing Cases</h3>

            </div>

            <div class="card cards">
                <i class="fas fa-dollar-sign"></i>
                <p>you have</p>
                <p>$12,000</p>
                <h3>Payments Pending</h3>

            </div>

            <div class="card cards delayed">
                <i class="fas fa-hourglass-half"></i>
                <p>you have</p>
                <p>5</p>
                <h3>Delayed Cases</h3>

            </div>
        </div>

        <!-- Chart Section -->
        <div class="chart-container">
            <div class="heading">
                <h3>Case Analytics</h3>
            </div>


            <div class="chart-row">
                <!-- Pie Chart -->
                <div class="chart-item">
                    <h4>Case Stats</h4>
                    <div class="pie-chart-container">
                        <canvas id="casesPieChart"></canvas>
                    </div>
                </div>

                <!-- Bar Chart -->
                <div class="chart-item">
                    <h4>Cases Handled by Lawyer</h4>
                    <div class="bar-chart-container">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>

                <!-- Line Chart -->
                <div class="chart-item">
                    <h4>Cases Closed Over Time</h4>
                    <div class="line-chart-container">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data for the pie chart
        const data = {
            labels: ['Open Cases', 'Delayed Cases', 'Closed Cases', 'Upcoming Hearings'],
            datasets: [{
                label: 'Case Distribution',
                data: [15, 5, 20, 10], // Replace with dynamic data from backend
                backgroundColor: [
                    'rgb(77, 46, 0,0.8)', // Dark Orange (Delayed Cases)
                    'rgb(153, 92, 0,0.8)', // Green (Closed Cases)
                    'rgb(230, 138, 0,0.8)', // Navy (Active Cases)
                    'rgb(255, 173, 51,0.8)' // Red (Pending Cases)
                ],
                borderColor: [
                    'rgb(77, 46, 0)', // Dark Orange (Delayed Cases)
                    'rgb(153, 92, 0)', // Green (Closed Cases)
                    'rgb(230, 138, 0)', // Navy (Active Cases)
                    'rgb(255, 173, 51)' // Red (Pending Cases)
                ],
                borderWidth: 1
            }]
        };

        // Configuration for the pie chart
        const config = {
            type: 'pie', // Pie chart type
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        };

        // Render the pie chart
        const casesPieChart = new Chart(
            document.getElementById('casesPieChart'),
            config
        );


        // Bar chart data and configuration
        new Chart(document.getElementById("barChart"), {
            type: "bar",
            data: {
                labels: ['Attorney 1', 'Attorney 2', 'Attorney 3'],
                datasets: [{
                    label: 'Cases Handled',
                    data: [10, 25, 5],
                    backgroundColor: ['#ff6b6b', '#4e73df', '#1cc88a'],
                }]
            },
            options: {
                responsive: true
            }
        });

        // Line chart data and configuration
        new Chart(document.getElementById("lineChart"), {
            type: "line",
            data: {
                labels: ['January', 'February', 'March', 'April'],
                datasets: [{
                    label: 'Cases Closed',
                    data: [5, 10, 15, 20],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

</body>

</html>