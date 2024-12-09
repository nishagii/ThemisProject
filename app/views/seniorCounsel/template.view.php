<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/template.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- this is imported to use icons -->

</head>

<body>

    <div class='main-container'>
        <?php include('component/bigNav.view.php'); ?>
        <?php include('component/smallNav1.view.php'); ?>
        <div class="temp-section">
            <h1>Document Templates</h1>
        </div>
        <div class="template-container">


            <div class="search-container">
                <input type="text" placeholder="Search here for templates" class="search-bar" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'" />
                <i class="bx bx-sort sort-icon" title="Sort" onclick="sortFunction()"></i>
                <i class="bx bx-filter filter-icon" title="Filter" onclick="filterFunction()"></i>

                <!-- Dropdown Menu -->
                <div class="sort-dropdown" id="sortMenu">
                    <button class="dropdown-item" onclick="sortBy('name')">Sort by Name</button>
                    <button class="dropdown-item" onclick="sortBy('role')">Sort by Role</button>
                    <button class="dropdown-item" onclick="sortBy('date')">Sort by Date</button>
                </div>
            </div>

            <div class="add">
                <button class="add-button">
                    <i class="bx bx-plus"></i> Upload New Template
                </button>
            </div>

            <div class="template">
                <div class="header">
                    <div class="template-header">
                        <h2>Current Templates of You</h2>
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
                    <?php if (!empty($templates)): ?>
                    <?php foreach ($templates as $template): ?>
                        <tr>
                            <td><?php echo $template->name; ?></td>
                            <td><?php echo $template->description; ?></td>
                            <td><?php echo $template->uploaded_by; ?></td>
                            <td><?php echo $template->uploaded_date; ?></td>
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
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No precedents found in the database.</td>
                    </tr>
                <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>