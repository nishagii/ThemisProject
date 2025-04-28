<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Templates</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/template.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- this is imported to use icons -->
</head>

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    <div class='main-container home-section'>
        <div class="temp-section">
            <h1>Document Templates</h1>
        </div>

        <div class="template-container">
            <p> Add a new template to the list by clicking the button below.
                <span style="color: #fa9800; font-weight: bold;">Any user </span> can use templates listed here.
            </p>
            <div class="search-container">
                <input type="text"
                    class="search-bar"
                    placeholder="Search here for templates"
                    oninput="searchTemplates(this.value)"
                    onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Search here for templates'" />
                <div class="sort-wrapper">
                    <i class="bx bx-sort sort-icon" title="Sort" onclick="toggleSortMenu()"></i>
                    <div class="sort-dropdown" id="sortMenu">
                        <button class="dropdown-item" onclick="sortBy('name')">Sort by Name</button>
                        <button class="dropdown-item" onclick="sortBy('uploaded_by')">Sort by Role</button>
                        <button class="dropdown-item" onclick="sortBy('uploaded_date')">Sort by Date</button>
                    </div>
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
                    <tbody id="templatesTable">
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
                                <td colspan="6">No templates found in the database.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        // Toggle Sort Menu
        function toggleSortMenu() {
            event.stopPropagation(); // Prevent click propagation
            const sortMenu = document.getElementById("sortMenu");
            closeOtherMenus();
            sortMenu.style.display = sortMenu.style.display === "block" ? "none" : "block";
        }

        // Sort function - Sends an AJAX request
        function sortBy(criteria) {
            fetch(`<?= ROOT ?>/Template/sort/${criteria}`)
                .then(response => response.text()) // Get HTML response
                .then(data => {
                    document.getElementById("templatesTable").innerHTML = data; // Update table
                    attachDropdownListeners(); // Re-attach event listeners
                })
                .catch(error => console.error("Error:", error));

            // Hide the menu after selection
            toggleSortMenu();
        }

        // Toggle Filter Menu
        function toggleFilterMenu(event) {
            event.stopPropagation(); // Prevent click propagation
            const filterMenu = document.getElementById("filterMenu");
            closeOtherMenus();
            filterMenu.style.display = filterMenu.style.display === "block" ? "none" : "block";
        }

        // Close other menus
        function closeOtherMenus() {
            document.querySelectorAll(".sort-dropdown").forEach(menu => {
                menu.style.display = "none";
            });
        }

        // Close dropdown menus when clicking outside
        document.addEventListener("click", function() {
            closeOtherMenus();
        });

        // Example filter function
        function filterBy(criteria) {
            console.log(`Filtering by: ${criteria}`);
            closeOtherMenus();
        }

        // Confirm delete
        function confirmDelete(Id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this template? This action cannot be undone!",
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

        // Attach event listeners to dropdown buttons
        function attachDropdownListeners() {
            const actionMenus = document.querySelectorAll(".action-menu");

            actionMenus.forEach(menu => {
                const button = menu.querySelector(".dots-btn");
                const dropdown = menu.querySelector(".dropdown");

                button.addEventListener("click", function(e) {
                    e.stopPropagation(); // Prevent click propagation
                    // Toggle visibility of dropdown
                    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener("click", function() {
                document.querySelectorAll(".dropdown").forEach(dropdown => {
                    dropdown.style.display = "none";
                });
            });
        }

        // Initial attachment of event listeners
        document.addEventListener("DOMContentLoaded", function() {
            attachDropdownListeners();
        });

        function searchTemplates(query) {
            fetch("<?= ROOT ?>/Template/search", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `query=${encodeURIComponent(query)}`
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById("templatesTable").innerHTML = data;
                    attachDropdownListeners(); // re-attach action menu
                })
                .catch(error => console.error("Search error:", error));

        }
    </script>
</body>

</html>