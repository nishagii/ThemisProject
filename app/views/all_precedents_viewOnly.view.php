<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Precedents</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/precedentsAdmin/all_precedents.css">
</head>
<body>
<?php include('seniorCounsel/component/bigNav.view.php'); ?>
<?php include('seniorCounsel/component/smallNav1.view.php'); ?>
<?php include('seniorCounsel/component/sidebar.view.php'); ?>
    <div class="home-section">
        <div class="header">
            <h1>All Precedents</h1>
        </div>

        <!-- search bar -->
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
        </div>

    <div class="table-container">
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
                                <a href="<?= ROOT ?>/PrecedentsController/retrieveOneViewOnly/<?= $case->id; ?>">
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
            let menu = document.getElementById("sortMenu");
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
    </script>
</body>
</html>
