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
                        <th>Court</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($recentCases) && is_array($recentCases) && count($recentCases) > 0): ?>
                        <?php foreach ($recentCases as $case): ?>
                            <tr>
                                <td><?= $case->case_number ?></td>
                                <td><?= $case->client_name ?></td>
                                <td><?= $case->case_status ?></td>
                                <td><?= $case->court ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No recent cases found</td>
                        </tr>
                    <?php endif; ?>
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
                <?php if (isset($ongoingCasesCount) && $ongoingCasesCount > 0): ?>
                    <p><?= $ongoingCasesCount ?></p>
                    <h3>Ongoing Cases</h3>
                <?php else: ?>
                    <p>0</p>
                    <h3>No Ongoing Cases</h3>
                <?php endif; ?>
            </div>

            <div class="card cards">
                <i class="fas fa-dollar-sign"></i>
                <p>you have</p>
                <?php if (isset($totalAmount) && $totalAmount > 0): ?>
                    <p>$<?= number_format($totalAmount, 2) ?></p>
                    <h3>Monthly Payments</h3>
                <?php else: ?>
                    <p>$0.00</p>
                    <h3>No Payments This Month</h3>
                <?php endif; ?>
            </div>

            <div class="card cards delayed">
                <i class="fas fa-hourglass-half"></i>
                <p>you have</p>
                <?php if (isset($delayedCases) && $delayedCases > 0): ?>
                    <p><?= $delayedCases ?></p>
                    <h3>Delayed Cases</h3>
                <?php else: ?>
                    <h3>No Delayed Cases</h3>
                <?php endif; ?>
            </div>

            <!-- Pie Chart -->
            <div class=" card cards ">
                <h3>Case Stats</h3>
                <div class="pie-chart-container">
                    <canvas id="casesPieChart"></canvas>
                </div>

            </div>
        </div>


        <!-- Chart Section -->
        <div class="chart-container">
            <div class="heading">
                <h3>Case Analytics</h3>
                <p> Analytics about the cases handled by
                    <span style="color: #fa9800; font-weight: bold;"> Attorneys </span> and <span style="color: #fa9800; font-weight: bold;"> Juniors. </span>.
                </p>
            </div>


            <div class="chart-row">


                <!-- Bar Chart -->
                <div class="chart-item">
                    <h4>Cases Handled by Attorneys</h4>
                    <div class="bar-chart-container">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>

                <!-- Bar Chart -->
                <div class="chart-item">
                    <h4>Cases Handled by Juniors</h4>
                    <div class="bar-chart-container">
                        <canvas id="juniorBarChart"></canvas>
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

    // Enhanced chart configurations
    <script>
        // Color palette that matches your design theme
        const themisColors = {
            primary: ['rgba(250, 152, 0, 0.8)', 'rgba(250, 152, 0, 0.6)', 'rgba(250, 152, 0, 0.4)'],
            secondary: ['rgba(29, 27, 49, 0.8)', 'rgba(29, 27, 49, 0.6)', 'rgba(29, 27, 49, 0.4)'],
            accent: [
                'rgba(77, 46, 0, 0.8)',
                'rgba(153, 92, 0, 0.8)',
                'rgba(230, 138, 0, 0.8)',
                'rgba(255, 173, 51, 0.8)',
                'rgba(255, 204, 128, 0.8)'
            ],
            borders: [
                'rgb(77, 46, 0)',
                'rgb(153, 92, 0)',
                'rgb(230, 138, 0)',
                'rgb(255, 173, 51)',
                'rgb(255, 204, 128)'
            ]
        };

        // Global Chart.js configuration
        Chart.defaults.font.family = "'Montserrat', sans-serif";
        Chart.defaults.font.size = 14;
        Chart.defaults.color = '#1d1b31';

        // Enhance tooltip style
        Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(29, 27, 49, 0.8)';
        Chart.defaults.plugins.tooltip.titleFont = {
            weight: 'bold',
            size: 14
        };
        Chart.defaults.plugins.tooltip.bodyFont = {
            size: 13
        };
        Chart.defaults.plugins.tooltip.padding = 10;
        Chart.defaults.plugins.tooltip.cornerRadius = 6;
        Chart.defaults.plugins.tooltip.borderColor = 'rgba(250, 152, 0, 0.5)';
        Chart.defaults.plugins.tooltip.borderWidth = 1;

        // Data for the pie chart with enhanced styling
        const pieData = {
            labels: <?= json_encode($pieChartData['labels']) ?>,
            datasets: [{
                label: 'Case Distribution',
                data: <?= json_encode($pieChartData['data']) ?>,
                backgroundColor: themisColors.accent,
                borderColor: themisColors.borders,
                borderWidth: 2,
                hoverOffset: 10
            }]
        };

        // Configuration for the pie chart
        const pieConfig = {
            type: 'pie',
            data: pieData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            boxWidth: 10,
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    title: {
                        display: false,
                        text: 'Case Distribution',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        };

        // Render the pie chart
        const casesPieChart = new Chart(
            document.getElementById('casesPieChart'),
            pieConfig
        );

        // Bar chart for attorneys
        new Chart(document.getElementById("barChart"), {
            type: "bar",
            data: {
                labels: <?= json_encode($attorneyChartData['labels']) ?>,
                datasets: [{
                    label: 'Cases Handled',
                    data: <?= json_encode($attorneyChartData['data']) ?>,
                    backgroundColor: themisColors.accent,
                    borderColor: themisColors.borders,
                    borderWidth: 2,
                    borderRadius: 6,
                    hoverBackgroundColor: themisColors.primary
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });

        // Bar chart for juniors
        new Chart(document.getElementById("juniorBarChart"), {
            type: "bar",
            data: {
                labels: <?= json_encode($juniorChartData['labels']) ?>,
                datasets: [{
                    label: 'Cases Handled',
                    data: <?= json_encode($juniorChartData['data']) ?>,
                    backgroundColor: themisColors.primary,
                    borderColor: 'rgba(250, 152, 0, 1)',
                    borderWidth: 2,
                    borderRadius: 6,
                    hoverBackgroundColor: themisColors.accent[2]
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });

        // Line chart for cases closed over time
        new Chart(document.getElementById("lineChart"), {
            type: "line",
            data: {
                labels: <?= json_encode($lineChartData['labels']) ?>,
                datasets: [{
                    label: 'Cases Closed',
                    data: <?= json_encode($lineChartData['data']) ?>,
                    borderColor: 'rgba(250, 152, 0, 1)',
                    backgroundColor: 'rgba(250, 152, 0, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointBackgroundColor: 'rgba(29, 27, 49, 0.8)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                },
                animation: {
                    duration: 2000
                }
            }
        });
    </script>

</body>

</html>