
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/template.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<?php include('component/bigNav.view.php'); ?>
<?php include('component/smallNav1.view.php'); ?>

<div class="template-container">
    <h3>Templates</h3>

    <div class="search-container">
        <input type="text" placeholder="Search" class="search-bar" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'" /> 
        <i class="bx bx-sort sort-icon" title="Sort" onclick="sortFunction()"></i>
        <i class="bx bx-filter filter-icon" title="Filter" onclick="filterFunction()"></i>

        <!-- Dropdown Menu -->
        <div class="sort-dropdown" id="sortMenu">
            <button class="dropdown-item" onclick="sortBy('name')">Sort by Name</button>
            <button class="dropdown-item" onclick="sortBy('role')">Sort by Role</button>
            <button class="dropdown-item" onclick="sortBy('date')">Sort by Date</button>
        </div>
    </div>

    <div class="template">
        <div class="header">
            <div class="template-header">
                <h2>Templates</h2>
            </div>
        </div>
        
        <table class="template-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Uploaded By</th>
                    <th>Uploaded Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John Doe</td>
                    <td>Template for legal case documents</td>
                    <td>John(Admin)</td>
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
                    <td>Sample Template</td>
                    <td>Template for client agreements</td>
                    <td>Jane(Admin)</td>
                    <td>15/09/2024</td>
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
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</div>

</body>
</html>