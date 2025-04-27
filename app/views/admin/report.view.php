<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Admin Reports</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/report.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php include('component/navBar.view.php'); ?>
    <?php include('component/sideBar.view.php'); ?>

    <div class="parent-container home-section">
        <div class="reports-header">
            <h1>Reports Dashboard</h1>
            <p>Generate and view system reports</p>
        </div>
       
        <div class="card-container">
            <div class="card white-card">
                <div class="icon purple"><i class="fas fa-users"></i></div>
                <h3>User Activity</h3>
                <p>User login and engagement metrics</p>
                <a href="<?= ROOT ?>/AdminReports/user" class="report-btn">Generate Report</a>
            </div>

            <div class="card blue-card">
                <div class="icon green"><i class="fas fa-balance-scale"></i></div>
                <h3>Legal Team Performance</h3>
                <p>Case handling and response times</p>
                <a href="<?= ROOT ?>/AdminReports/legal" class="report-btn">Generate Report</a>
            </div>

            <div class="card dark-card">
                <div class="icon"><i class="fas fa-user-tie"></i></div>
                <h3>Client Analytics</h3>
                <p>Client engagement and satisfaction</p>
                <a href="<?= ROOT ?>/AdminReports/client" class="report-btn">Generate Report</a>
            </div>
            
            <div class="card orange-card">
                <div class="icon orange"><i class="fas fa-file-alt"></i></div>
                <h3>System Reports</h3>
                <p>Performance and error logs</p>
                <a href="<?= ROOT ?>/AdminReports/system" class="report-btn">Generate Report</a>
            </div>
        </div>

        <div class="report-sections">
            <div class="recent-reports">
                <div class="header">
                    <h2>Recent Reports</h2>
                    <div class="wave"></div>
                </div>

                <div class="reports-list">
                    <?php if (!empty($recent_reports)): ?>
                        <?php foreach (array_slice($recent_reports, 0, 5) as $report): ?>
                            <div class="report-item">
                                <div class="report-info">
                                    <div class="report-icon">
                                        <i class="fas <?php echo getReportIcon($report->type); ?>"></i>
                                    </div>
                                    <div class="report-details">
                                        <h4><?php echo htmlspecialchars($report->title); ?></h4>
                                        <span class="date"><?php echo date('F j, Y', strtotime($report->generated_date)); ?></span>
                                    </div>
                                </div>
                                <div class="report-actions">
                                    <a href="<?= ROOT ?>/AdminReports/view/<?php echo $report->id; ?>" class="view-btn">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?= ROOT ?>/AdminReports/download/<?php echo $report->id; ?>" class="download-btn">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="view-all-button">
                            <a href="<?= ROOT ?>/AdminReports/history" class="btn">View All Reports</a>
                        </div>
                    <?php else: ?>
                        <p>No reports generated yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="custom-report">
                <div class="header">
                    <h2>Custom Report</h2>
                    <div class="wave"></div>
                </div>
                <div class="custom-report-form">
                    <form action="<?= ROOT ?>/AdminReports/generate" method="post">
                        <div class="form-group">
                            <label for="report-type">Report Type</label>
                            <select id="report-type" name="report_type" required>
                                <option value="" disabled selected>Select Report Type</option>
                                <option value="user">User Activity</option>
                                <option value="legal">Legal Team Performance</option>
                                <option value="client">Client Analytics</option>
                                <option value="system">System Performance</option>
                                <option value="custom">Custom Query</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date-range">Date Range</label>
                            <select id="date-range" name="date_range">
                                <option value="today">Today</option>
                                <option value="week">Last 7 Days</option>
                                <option value="month" selected>Last 30 Days</option>
                                <option value="quarter">Last Quarter</option>
                                <option value="year">Last Year</option>
                                <option value="custom">Custom Range</option>
                            </select>
                        </div>
                        <div class="date-range-custom" style="display: none;">
                            <div class="form-group">
                                <label for="start-date">Start Date</label>
                                <input type="date" id="start-date" name="start_date">
                            </div>
                            <div class="form-group">
                                <label for="end-date">End Date</label>
                                <input type="date" id="end-date" name="end_date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="format">Export Format</label>
                            <select id="format" name="format">
                                <option value="pdf">PDF</option>
                                <option value="excel">Excel</option>
                                <option value="csv">CSV</option>
                            </select>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="generate-btn">
                                <i class="fas fa-file-export"></i> Generate Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="report-analytics">
            <div class="header">
                <h2>Report Analytics</h2>
                <div class="wave"></div>
            </div>
            <div class="analytics-cards">
                <div class="analytics-card">
                    <div class="analytics-icon"><i class="fas fa-chart-line"></i></div>
                    <div class="analytics-content">
                        <h4>Most Generated</h4>
                        <p><?= !empty($most_generated) ? htmlspecialchars($most_generated) : 'User Activity' ?></p>
                    </div>
                </div>
                <div class="analytics-card">
                    <div class="analytics-icon"><i class="fas fa-download"></i></div>
                    <div class="analytics-content">
                        <h4>Downloads</h4>
                        <p><?= htmlspecialchars($total_downloads ?? 0) ?></p>
                    </div>
                </div>
                <div class="analytics-card">
                    <div class="analytics-icon"><i class="fas fa-clock"></i></div>
                    <div class="analytics-content">
                        <h4>Avg. Generation Time</h4>
                        <p><?= htmlspecialchars($avg_generation_time ?? '2.3s') ?></p>
                    </div>
                </div>
                <div class="analytics-card">
                    <div class="analytics-icon"><i class="fas fa-calendar-alt"></i></div>
                    <div class="analytics-content">
                        <h4>This Month</h4>
                        <p><?= htmlspecialchars($reports_this_month ?? 0) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateRange = document.getElementById('date-range');
            const customRange = document.querySelector('.date-range-custom');

            dateRange.addEventListener('change', function() {
                if (this.value === 'custom') {
                    customRange.style.display = 'flex';
                } else {
                    customRange.style.display = 'none';
                }
            });
        });

        // Helper function for PHP
        <?php
        function getReportIcon($type) {
            $icons = [
                'user' => 'fa-users',
                'legal' => 'fa-balance-scale',
                'client' => 'fa-user-tie',
                'system' => 'fa-server',
                'custom' => 'fa-file-alt'
            ];
            
            return $icons[$type] ?? 'fa-file-alt';
        }
        ?>
    </script>
</body>

</html>