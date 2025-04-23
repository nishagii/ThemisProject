<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- this is imported to use icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/client/home.css">

</head>

<body>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('login') === 'success') {
            Swal.fire({
                title: 'Welcome Back!',
                text: 'You have successfully logged in.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false,
            });
        }
    </script>

    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include(__DIR__ . '/../seniorCounsel/component/sidebar.view.php'); ?>

    <div class="dashboard-container">


        <!-- Main Content -->
        <main class="home-section">
            <div class="home-body">
                <header class="header">
                    <h1>Welcome, <span class="user-name"><?= htmlspecialchars($username) ?></span>!</h1>
                    <p>Your case updates and notifications are here.</p>
                </header>

                <!-- Case Progress Section -->
            <section id="case-progress" class="case-progress">
                <h2><i class="fas fa-tasks"></i> Case Progress</h2>

                <?php if (!empty($cases) && is_array($cases)): ?>
                    <?php foreach ($cases as $case): ?>
                        <div class="case-card">
                            <h3>Case: <?= htmlspecialchars($case['case_number']) ?></h3>
                            <p>Status: 
                                <span class="status <?= strtolower(str_replace(' ', '-', $case['status'])) ?>">
                                    <?= htmlspecialchars($case['status']) ?>
                                </span>
                            </p>
                            <p>
                                <i class="fas fa-clock"></i> Last Updated: <?= htmlspecialchars($case['last_updated']) ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-cases-message">
                            <div class="no-cases-icon">
                                <i class="fas fa-folder-open"></i>
                            </div>
                            <div class="no-cases-content">
                                <h4>No Cases Found</h4>
                                <p>You are not currently assigned to any legal cases.</p>
                            </div>
                        </div>
                    <?php endif; ?>
            </section>


                <!-- Upcoming Hearings Section -->
                <section id="hearings" class="upcoming-hearings">
                    <h2><i class="fas fa-calendar-alt"></i> Upcoming Hearings</h2>
                    <table>
                        <thead>
                            <tr>
                                <th><i class="fas fa-file-alt"></i> Case Number</th>
                                <th><i class="fas fa-calendar-day"></i> Date</th>
                                <th><i class="fas fa-clock"></i> Time</th>
                                <th><i class="fas fa-map-marker-alt"></i> Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2212/54</td>
                                <td>2024-12-15</td>
                                <td>10:00 AM</td>
                                <td>Supreme Court, Room 5</td>
                            </tr>
                            <tr>
                                <td>2195/28</td>
                                <td>2024-12-20</td>
                                <td>2:30 PM</td>
                                <td>District Court, Room 2</td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <!-- Notifications Section -->
                <section id="notifications" class="notifications">
                    <h2><i class="fas fa-bell"></i> Notifications</h2>
                    <ul>
                        <li><i class="fas fa-file-upload"></i> Case 2212/54: Document submission completed on 2024-11-20.</li>
                        <li><i class="fas fa-calendar-check"></i> Case 2195/28: Hearing scheduled on 2024-12-20.</li>
                    </ul>
                </section>

                <!-- Payments Section -->
                <section id="payments" class="payments">
                    <h2><i class="fas fa-wallet"></i> Payment History</h2>
                    <table>
                        <thead>
                            <tr>
                                <th><i class="fas fa-calendar"></i> Date</th>
                                <th><i class="fas fa-dollar-sign"></i> Amount</th>
                                <th><i class="fas fa-check-circle"></i> Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024-11-15</td>
                                <td>$500</td>
                                <td class="paid">Paid</td>
                            </tr>
                            <tr>
                                <td>2024-10-30</td>
                                <td>$200</td>
                                <td class="pending">Pending</td>
                            </tr>
                        </tbody>
                    </table>
                </section>

            </div>
            
        </main>
    </div>
</body>

</html>