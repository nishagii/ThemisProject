<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Admin Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- this is imported to use icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php include('component/navBar.view.php'); ?>
    <?php include('component/sideBar.view.php'); ?>

    <div class="parent-container">
        <div class="counters-container">
            <div class="counter total" onclick="scrollToTable()">
                <div class="counter-icon">
                    <i class="fas fa-users"></i>
                </div>
                <strong>Total No of Users:</strong>
                <span class="total-users">200</span>
            </div>
            <div class="individual">
                <div class="counter" onclick="scrollToTable()">
                    <div class="counter-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3>Legal Team</h3>
                    <span>Users: 6</span>
                </div>
                <div class="counter" onclick="scrollToTable()">
                    <div class="counter-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3>Clients</h3>
                    <span>Users: 194</span>
                </div>
            </div>
        </div>

        <div class="search-container">
            <input
                type="text"
                placeholder="Search"
                class="search-bar"
                onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Search'" />
            <i class="bx bx-sort sort-icon" title="Sort" onclick="toggleSortMenu()"></i>
            <i class="bx bx-filter filter-icon" title="Filter" onclick="filterFunction()"></i>

            <!-- Dropdown Menu -->
            <div class="sort-dropdown" id="sortMenu">
                <button class="dropdown-item">Sort by Name</button>
                <button class="dropdown-item">Sort by Role</button>
                <button class="dropdown-item">Sort by Date</button>
            </div>

            <!-- Filter Dropdown Menu -->
            <div class="filter-dropdown" id="filterMenu">
                <button class="dropdown-item">
                    Filter by Role
                    <span class="arrow-icon"></span>
                    <div class="submenu up">
                        <label>
                            <input type="radio" name="role-filter" value="admin"> Admin
                        </label>
                        <label>
                            <input type="radio" name="role-filter" value="user"> Legal Team
                        </label>
                        <label>
                            <input type="radio" name="role-filter" value="guest"> Client
                        </label>
                    </div>
                </button>
                <button class="dropdown-item">
                    Filter by Status
                    <span class="arrow-icon"></span>
                    <div class="submenu down">
                        <label>
                            <input type="radio" name="status-filter" value="active"> Active
                        </label>
                        <label>
                            <input type="radio" name="status-filter" value="inactive"> Inactive
                        </label>
                    </div>
                </button>
            </div>

        </div>



        <div class="add-user">
            <a href="<?= ROOT ?>/admin">
                <button class="add-user-button">
                    <i class="bx bx-user-plus"></i> Add User
                </button>
            </a>
        </div>


        <div class="user-management" id="userManagement">
            <div class="header">
                <div class="user-header">
                    <h2>Users</h2>
                </div>
            </div>

            <table class="user-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>Admin</td>
                        <td><span class="status active">Active</span></td>
                        <td>12/09/2024</td>
                        <td>
                            <div class="action-menu">
                                <button class="dots-btn">⋮</button>
                                <div class="dropdown">
                                    <button class="dropdown-item">Edit</button>
                                    <button class="dropdown-item">Delete</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>Legal Team</td>
                        <td><span class="status inactive">Inactive</span></td>
                        <td>12/09/2024</td>
                        <td>
                            <div class="action-menu">
                                <button class="dots-btn">⋮</button>
                                <div class="dropdown">
                                    <button class="dropdown-item">Edit</button>
                                    <button class="dropdown-item">Delete</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>


            </table>
        </div>


    </div>


</body>

</html>