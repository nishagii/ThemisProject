<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Admin Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php include('component/navBar.view.php'); ?>
    <?php include('component/sideBar.view.php'); ?>
    
    <div class="home-section">
        <div class="user-section">
            <h1>System Users</h1>
            
            <div class="controls-row">
                <div class="flex">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="search-input" placeholder="Search by name, email, role...">
                    </div>

                    <div class="sort-dropdown">
                        <select id="sort-users">
                            <option value="">Sort by</option>
                            <option value="name">Name</option>
                            <option value="email">Email</option>
                        </select>
                    </div>

                    <div class="filter-dropdown">
                        <button class="filter-btn" id="filter-btn">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <div class="filter-menu" id="filter-menu">
                            <div class="filter-group">
                                <h4>Role</h4>
                                <div class="filter-options">
                                    <div class="filter-option">
                                        <label>
                                            <input type="checkbox" data-filter="role" value="admin"> Admin
                                        </label>
                                    </div>
                                    <div class="filter-option">
                                        <label>
                                            <input type="checkbox" data-filter="role" value="client"> Client
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="filter-group">
                                <h4>Status</h4>
                                <div class="filter-options">
                                    <div class="filter-option">
                                        <label>
                                            <input type="checkbox" data-filter="status" value="active"> Active
                                        </label>
                                    </div>
                                    <div class="filter-option">
                                        <label>
                                            <input type="checkbox" data-filter="status" value="inactive"> Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="filter-actions">
                                <button class="reset-btn" id="reset-filters">Reset</button>
                                <button class="apply-btn" id="apply-filters">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="<?= ROOT ?>/admin">
                    <button class="create-button">
                        <i class="bx bx-plus"></i> Create User
                    </button>
                </a>
            </div>

            
            <?php if (!empty($users)) : ?>
                <table id="users-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="user-table-body">
                    <?php foreach ($users as $user) : ?>
                        <?php 
                            $status = ($user->active ?? true) ? 'active' : 'inactive';
                            $role = strtolower(htmlspecialchars($user->role));
                            $username = htmlspecialchars($user->username);
                            $email = htmlspecialchars($user->email);
                        ?>
                        <tr data-name="<?= strtolower($username) ?>" data-email="<?= strtolower($email) ?>" data-role="<?= $role ?>" data-status="<?= $status ?>">
                            <td><?= htmlspecialchars($user->id) ?></td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <span><?= strtoupper(substr($username, 0, 1)) ?></span>
                                    </div>

                                    <?= $username ?>
                                    <?php if ($user->verified ?? false) : ?>
                                        <span class="verified-badge"><i class="fas fa-check"></i></span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td><?= $email ?></td>
                            <td>
                                <span class="status-tag <?= $role === 'admin' ? 'status-customer' : 'status-prospect' ?>">
                                    <?= htmlspecialchars($user->role) ?>
                                </span>
                            </td>
                            <td>
                                <span class="status-badge <?= $status === 'active' ? 'badge-active' : 'badge-inactive' ?>">
                                    <?= ucfirst($status) ?>
                                </span>
                            </td>
                            <td class="actions">
                                <a href="<?= ROOT ?>/UsersAdmin/viewUser/<?= $user->id ?>" class="action-btn view-btn" title="View Details">
                                    <i class="bx bx-show"></i>
                                </a>
                                <a href="<?= ROOT ?>/admin/users/delete/<?= $user->id ?>" class="action-btn delete-btn" title="Delete User" 
                                   onclick="return confirm('Are you sure you want to delete this user?');">
                                    <i class="bx bx-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div id="no-results" class="empty-state" style="display: none;">
                    <div class="empty-icon">
                        <i class="bx bx-user-x"></i>
                    </div>
                    <h3>No users found</h3>
                    <p>There are no users matching your criteria.</p>
                </div>
            <?php else : ?>
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bx bx-user-x"></i>
                    </div>
                    <h3>No users found</h3>
                    <p>There are no users matching your criteria.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/admin/user.js"> </script>
</body>
</html>