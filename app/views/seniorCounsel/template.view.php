<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>templates</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/template.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- this is imported to use icons -->

</head>

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <div class='main-container'>
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
            <a href="<?= ROOT ?>/template/create">
                <button class="add-button">
                    <i class="bx bx-plus"></i> Upload New Template
                </button>
            </a>
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
                                        <!-- Download -->
                                        <a href="<?php echo $template->document_link; ?>" target="_blank" class="dropdown-item">Download</a>
                                        <!-- Edit -->
                                        <a href="<?= ROOT ?>/template/edit/<?= $template->id ?>" class="dropdown-item">Edit</a>
                                        <!-- Delete -->
                                        <a href="javascript:void(0);" onclick="confirmDelete(<?= $template->id; ?>)" class="dropdown-item">Delete</a>  
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
    <script>
        //confirm delete
        function confirmDelete(Id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this case? This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#93a8e3',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                background: '#fafafa',
                color: '#1d1b31',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the delete action
                    window.location.href = `<?= ROOT ?>/template/delete/${Id}`;
                }
            });
        }
    // Toggle the dropdown menu
        document.addEventListener("DOMContentLoaded", function () {
            const actionMenus = document.querySelectorAll(".action-menu");

            actionMenus.forEach(menu => {
                const button = menu.querySelector(".dots-btn");
                const dropdown = menu.querySelector(".dropdown");

                button.addEventListener("click", function (e) {
                    e.stopPropagation(); // Prevent click propagation
                    // Toggle visibility of dropdown
                    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener("click", function () {
                document.querySelectorAll(".dropdown").forEach(dropdown => {
                    dropdown.style.display = "none";
                });
            });
        });
</script>
</body>
</html>