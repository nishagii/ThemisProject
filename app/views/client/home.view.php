<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
        <main class="home-section">
            <div class="home-body">
                <header class="header">
                    <h1>Welcome, <span class="user-name"><?= htmlspecialchars($username) ?></span>!</h1>
                </header>

                <!-- Case Progress Section -->
                <section id="case-progress" class="case-progress">
                    <h2><i class="fas fa-tasks"></i> Case Progress</h2>
                    <?php if (!empty($cases) && is_array($cases)): ?>
                        <?php foreach ($cases as $case): ?>
                            <div class="case-card">
                                <h3>Case: <?= htmlspecialchars($case->case_number) ?></h3>
                                <p>Status: 
                                    <span class="status <?= strtolower(str_replace(' ', '-', $case->case_status)) ?>">
                                        <?= htmlspecialchars($case->case_status) ?>
                                    </span>
                                </p>
                               
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-cases-message">
                            <div class="no-cases-icon"><i class="fas fa-folder-open"></i></div>
                            <div class="no-cases-content">
                                <h4>No Cases Found</h4>
                                <p>You are not currently assigned to any legal cases.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </section>

                <!-- Invoices Section -->
                <section id="invoices" class="invoices">
                    <h2><i class="fas fa-file-invoice-dollar"></i> Recent Invoices</h2>
                    <?php if (!empty($invoices) && is_array($invoices)): ?>
                        <?php foreach ($invoices as $invoice): ?>
                            <div class="invoice-card">
                                <h3>Invoice: #<?= htmlspecialchars($invoice->invoiceID) ?></h3>
                                <p>Amount: $<?= htmlspecialchars(number_format($invoice->amount, 2)) ?></p>
                                
                                <p>
                                     Due Date: <?= htmlspecialchars($invoice->dueDate) ?>
                                </p>
                                <div class="invoice-actions">
                                    <a href="<?= ROOT ?>/client/viewInvoice/<?= $invoice->id ?>" class="view-btn">
                                         View
                                    </a>
                                    
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-invoices-message">
                            <div class="no-invoices-icon"><i class="fas fa-file-invoice"></i></div>
                            <div class="no-invoices-content">
                                <h4>No Invoices Found</h4>
                                <p>You don't have any recent invoices.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </section>

                <div class="flex">
                    <div class="login-container">
                        <div class="header">
                            <h2>Recent Login Activity</h2>
                        </div>
                        <div class="login-list">
                            <?php if (!empty($logins)): ?>
                                <?php 
                                $loginCount = count($logins);
                                $displayLogins = array_slice($logins, 0, 3);
                                foreach ($displayLogins as $login): 
                                ?>
                                    <div class="login">
                                        <div class="login-info">
                                            <div class="login-icon"><i class="fas fa-key"></i></div>
                                            <div class="text-info">
                                                <div class="date"><?= date('F j, Y', strtotime($login->login_time)); ?></div>
                                                <div class="time"><?= date('g:i a', strtotime($login->login_time)); ?></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="ip"><?= htmlspecialchars($login->ip_address); ?></div>
                                            <div class="status"><?= htmlspecialchars($login->status); ?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <?php if ($loginCount > 3): ?>
                                    <div class="view-more-container">
                                        <a href="<?= ROOT ?>/client/loginHistory" class="view-more-btn">
                                            <i class="fas fa-history"></i> View All Login History
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <p>No login history available.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Meetings Section -->
                    <section id="meetings" class="meetings">
                        <h2><i class="fas fa-handshake"></i> Recent Meeting Requests</h2>
                        <?php if (!empty($meetings) && is_array($meetings)): ?>
                            <?php foreach ($meetings as $meeting): ?>
                                <div class="meeting-card">
                                   
                                    <p>Date: <i class="fas fa-calendar"></i> <?= htmlspecialchars($meeting->meeting_date) ?></p>
                                    <p>Time: <i class="fas fa-clock"></i> <?= htmlspecialchars($meeting->meeting_time) ?></p>
                                    <p>Status: 
                                        <span class="status <?= strtolower(str_replace(' ', '-', $meeting->meetin_status)) ?>">
                                            <?= htmlspecialchars($meeting->meeting_status) ?>
                                        </span>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="no-meetings-message">
                                <div class="no-meetings-icon"><i class="fas fa-calendar-times"></i></div>
                                <div class="no-meetings-content">
                                    <h4>No Meeting Requests Found</h4>
                                    <p>You haven't requested any meetings yet.</p>
                                    <a href="<?= ROOT ?>/client/requestMeeting" class="request-meeting-btn">
                                         Request a Meeting
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </section>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
