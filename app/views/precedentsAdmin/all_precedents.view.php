<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Precedents</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/precedentsAdmin/all_precedents.css">
</head>
<body>
<?php include('components/bigNav.view.php'); ?>
    <div class="header">
        <h1>All Precedents</h1>
    </div>

    <div class="table-container">
        <div class="search-bar-container">
            <input type="text" 
            id="searchBar" 
            class="search-bar" 
            placeholder="Search precedents..." 
            oninput="searchPrecedents()" 
            onfocus="this.placeholder = ''"
            onblur="this.placeholder = 'Search precedents...' ">
            <i class="bx bx-sort sort-icon" title="Sort" onclick="toggleSortMenu()"></i>
            <i class="bx bx-filter filter-icon" title="Filter" onclick="filterFunction()"></i>

            <div class="sort-dropdown" id="sortMenu">
                <button class="dropdown-item" onclick="sortBy('judgment_date')">Sort by Date</button>
                <button class="dropdown-item" onclick="sortBy('case_number')">Sort by Case Number</button>
                <button class="dropdown-item" onclick="sortBy('judgment_by')">Sort by Judge</button>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Case Number</th>
                    <th>Description</th>
                    <th>Judgment By</th>
                    <th>Document Link</th>
                    <th>View More</th>
                </tr>
            </thead>
            <tbody id="precedentsTable">
                <?php if (!empty($cases)): ?>
                    <?php foreach ($cases as $case): ?>
                        <tr>
                            <td><?php echo $case->judgment_date; ?></td>
                            <td><?php echo $case->case_number; ?></td>
                            <td><?php echo $case->description; ?></td>
                            <td><?php echo $case->judgment_by; ?></td>
                            <td><a href="<?php echo $case->document_link; ?>" target="_blank">View Document</a></td>
                            <td>
                                <a href="<?= ROOT ?>/PrecedentsController/retrieveOne/<?= $case->id; ?>">
                                <button class="more">View more</button>
                                </a>
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
    <script>
        function toggleSortMenu() {
            event.stopPropagation()
            let menu = document.getElementById("sortMenu");
            closeOtherMenus();
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }

        // Sort function - Sends an AJAX request
        function sortBy(criteria) {
            fetch(`<?= ROOT ?>/PrecedentsController/sort/${criteria}`)
                .then(response => response.text())  // Get HTML response
                .then(data => {
                    document.getElementById("precedentsTable").innerHTML = data; // Update table
                })
                .catch(error => console.error("Error:", error));

            // Hide the menu after selection
            toggleSortMenu();
        }

        // Close the dropdown when clicking outside
        document.addEventListener("click", function (event) {
            let menu = document.getElementById("sortMenu");
            if (event.target.closest(".sort-icon") === null) {
                menu.style.display = "none";
            }
        });
        function closeOtherMenus() {
            document.querySelectorAll(".sort-dropdown").forEach(menu => {
                menu.style.display = "none";
            });
        }
    </script>
</body>
</html>
