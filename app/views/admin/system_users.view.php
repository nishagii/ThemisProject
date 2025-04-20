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
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search by name, email, role...">
                </div>
                <button class="create-button">
                    <i class="bx bx-plus"></i> Create User
                </button>
            </div>
            
            <?php if (!empty($users)) : ?>
                <table>
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
                    <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= htmlspecialchars($user->id) ?></td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <span><?= strtoupper(substr(htmlspecialchars($user->username), 0, 1)) ?></span>
                                    </div>

                                    <?= htmlspecialchars($user->username) ?>
                                    <?php if ($user->verified ?? false) : ?>
                                        <span class="verified-badge"><i class="fas fa-check"></i></span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($user->email) ?></td>
                            <td>
                                <span class="status-tag <?= strtolower(htmlspecialchars($user->role)) === 'admin' ? 'status-customer' : 'status-prospect' ?>">
                                    <?= htmlspecialchars($user->role) ?>
                                </span>
                            </td>
                            <td>
                                <span class="status-indicator <?= ($user->active ?? true) ? 'active' : 'inactive' ?>"></span>
                                <?= ($user->active ?? true) ? 'Active' : 'Inactive' ?>
                            </td>
                            <td class="actions">
                                <a href="<?= ROOT ?>/admin/users/view/<?= $user->id ?>" class="action-btn view-btn" title="View Details">
                                    <i class="bx bx-show"></i>
                                </a>
                                <a href="<?= ROOT ?>/admin/users/edit/<?= $user->id ?>" class="action-btn edit-btn" title="Edit User">
                                    <i class="bx bx-edit"></i>
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
                
                <div class="pagination">
                    <button class="pagination-btn prev" <?= $page <= 1 ? 'disabled' : '' ?>>
                        <i class="bx bx-chevron-left"></i> Previous
                    </button>
                    <div class="page-info">
                        Page <span class="current-page"><?= $page ?? 1 ?></span> of <span class="total-pages"><?= $totalPages ?? 1 ?></span>
                    </div>
                    <button class="pagination-btn next" <?= ($page ?? 1) >= ($totalPages ?? 1) ? 'disabled' : '' ?>>
                        Next <i class="bx bx-chevron-right"></i>
                    </button>
                </div>
            <?php else : ?>
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bx bx-user-x"></i>
                    </div>
                    <h3>No users found</h3>
                    <p>There are no users matching your criteria.</p>
                    <button class="create-button">
                        <i class="bx bx-plus"></i> Add New User
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Add any JavaScript functionality you need here
        document.addEventListener('DOMContentLoaded', function() {
            // Example: Filter functionality
            const filterTags = document.querySelectorAll('.filter-tag .close');
            filterTags.forEach(tag => {
                tag.addEventListener('click', function() {
                    this.parentElement.remove();
                    // Here you would typically trigger a filter update
                });
            });
            
            // Example: Search functionality
            const searchInput = document.querySelector('.search-box input');
            if (searchInput) {
                searchInput.addEventListener('keyup', function(e) {
                    if (e.key === 'Enter') {
                        // Handle search
                        console.log('Searching for:', this.value);
                        // You would typically submit a form or make an AJAX call here
                    }
                });
            }
        });
    </script>
</body>
</html>