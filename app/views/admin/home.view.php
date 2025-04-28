<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Admin Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php include('component/navBar.view.php'); ?>
    <?php include('component/sideBar.view.php'); ?>

    <div class="parent-container home-section">
       
        <div class="card-container">
            <a href="<?= ROOT ?>/UsersAdmin" class="card-link">
                <div class="card white-card">
                    <div class="icon purple"><i class="fas fa-users"></i></div>
                    <h3>Total Users</h3>
                    <p><?= htmlspecialchars($total_users) ?></p>
                </div>
            </a>


            <div class="card blue-card">
                <div class="icon green"><i class="fas fa-balance-scale"></i></div>
                <h3>Legal Team</h3>
                <p><?= htmlspecialchars($total_users - $total_clients) ?></p>
            </div>

            <div class="card dark-card">
                <div class="icon"><i class="fas fa-user-tie"></i></div>
                <h3>Clients</h3>
                <p><?= htmlspecialchars($total_clients) ?></p>
            </div>
        </div>

        <div class="actions">
            

            <div class="login-container">
                <div class="header">
                    <h2>Recent Login Activity</h2>
                    
                
                
                </div>

                <div class="login-list">
                    <?php if (!empty($login_details)): ?>
                        <?php foreach (array_slice($login_details, 0, 3) as $login): ?>
                            <div class="login">
                                <div class="login-info">
                                    <div class="login-icon"><i class="fas fa-key"></i></div>
                                    <div class="text-info">
                                        <div class="date">
                                            <?php echo date('F j, Y', strtotime($login->login_time)); ?>
                                        </div>
                                        <div class="time">
                                            <?php echo date('g:i a', strtotime($login->login_time)); ?>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="ip"><?php echo htmlspecialchars($login->ip_address); ?></div>
                                    <div class="status"><?php echo htmlspecialchars($login->status); ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="view-all-button">
                            <a href="<?= ROOT ?>/AdminLogin" class="btn">View All</a>
                        </div>
                    <?php else: ?>
                        <p>No login history available.</p>
                    <?php endif; ?>
                </div>


            </div>

            <div class="right-container">
                <div class="right-header">
                <h2>Quick Actions</h2>
                
                <div class="wave"></div>
                </div>
                <div class="categories">
                <div class="left-card yellow">
                <i class="fas fa-cogs"></i> 
                    <div>System Status</div>
                </div>
                <div class="left-card right-purple">
                    <i class="fas fa-user-plus"></i>
                    <div>New Users</div>
                </div>
                <div class="left-card pink">
                    <i class="fas fa-star"></i>

                    <div>Ratings and Feedbacks</div>
                </div>
                <div class="left-card teal">
                    <i class="fas fa-bug"></i>
                    <div>Bug Complaints</div>
                </div>
                </div>
            </div>

            <div class="quick-action">
                <div class="action-icon"></div>
                <div class="label">Reports</div>
                <button class="add-user-btn" onclick="window.location.href='<?= ROOT ?>/report'">
                    <i class="fas fa-file-alt"></i>
                    View
                </button>

                

            </div>
            
        </div>


    </div>


</body>

</html>