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
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    <div class="home-section">
        <div class="header">
            <h1>All Precedents</h1>
        </div>

        <div class="search-bar-container">
            <input type="text"
                id="searchBar"
                class="search-bar"
                placeholder="Search precedents..."
                oninput="searchPrecedents()"
                onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Search precedents...' ">

            <br>
            <br><br>

            <div class="icon-container">
                <i class="bx bx-sort sort-icon" title="Sort" onclick="toggleSortMenu()"></i>
                <div class="sort-dropdown" id="sortMenu">
                    <button class="dropdown-item" onclick="sortBy('judgment_date')">Sort by Date</button>
                    <button class="dropdown-item" onclick="sortBy('case_number')">Sort by Case Number</button>
                    <button class="dropdown-item" onclick="sortBy('judgment_by')">Sort by Judge</button>
                </div>
            </div>

            <div class="icon-container">
                <i class="bx bx-filter filter-icon" title="Filter" onclick="togglefilterMenu()"></i>
                <di class="filter-dropdown" id="filterMenu">
                    <button class="dropdown-item" onclick="toggleYearDropdown(event)">2020-2030</button>
                    <div class="year-dropdown" id="dropdown-2020" style="display: none;">
                        <button class="dropdown-item" onclick="filterByYear('2025')">2025</button>
                        <button class="dropdown-item" onclick="filterByYear('2024')">2024</button>
                        <button class="dropdown-item" onclick="filterByYear('2023')">2023</button>
                        <button class="dropdown-item" onclick="filterByYear('2022')">2022</button>
                        <button class="dropdown-item" onclick="filterByYear('2021')">2021</button>
                        <button class="dropdown-item" onclick="filterByYear('2020')">2020</button>
                    </div>
                    <button class="dropdown-item" onclick="toggleYearDropdown(event)">2010-2019</button>
                    <div class="year-dropdown" id="dropdown-2010" style="display: none;">
                        <button class="dropdown-item" onclick="filterByYear('2019')">2019</button>
                        <button class="dropdown-item" onclick="filterByYear('2018')">2018</button>
                        <button class="dropdown-item" onclick="filterByYear('2017')">2017</button>
                        <button class="dropdown-item" onclick="filterByYear('2016')">2016</button>
                        <button class="dropdown-item" onclick="filterByYear('2015')">2015</button>
                        <button class="dropdown-item" onclick="filterByYear('2014')">2014</button>
                        <button class="dropdown-item" onclick="filterByYear('2013')">2013</button>
                        <button class="dropdown-item" onclick="filterByYear('2012')">2012</button>
                        <button class="dropdown-item" onclick="filterByYear('2011')">2011</button>
                        <button class="dropdown-item" onclick="filterByYear('2010')">2010</button>
                    </div>
                    <button class="dropdown-item" onclick="toggleYearDropdown(event)">2000-2009</button>
                    <div class="year-dropdown" id="dropdown-2000" style="display: none;">
                        <button class="dropdown-item" onclick="filterByYear('2009')">2009</button>
                        <button class="dropdown-item" onclick="filterByYear('2008')">2008</button>
                        <button class="dropdown-item" onclick="filterByYear('2007')">2007</button>
                        <button class="dropdown-item" onclick="filterByYear('2006')">2006</button>
                        <button class="dropdown-item" onclick="filterByYear('2005')">2005</button>
                        <button class="dropdown-item" onclick="filterByYear('2004')">2004</button>
                        <button class="dropdown-item" onclick="filterByYear('2003')">2003</button>
                        <button class="dropdown-item" onclick="filterByYear('2002')">2002</button>
                        <button class="dropdown-item" onclick="filterByYear('2001')">2001</button>
                        <button class="dropdown-item" onclick="filterByYear('2000')">2000</button>
                    </div>
                    <button class="dropdown-item" onclick="toggleYearDropdown(event)">1990-1999</button>
                    <div class="year-dropdown" id="dropdown-1990" style="display: none;">
                        <button class="dropdown-item" onclick="filterByYear('1999')">1999</button>
                        <button class="dropdown-item" onclick="filterByYear('1998')">1998</button>
                        <button class="dropdown-item" onclick="filterByYear('1997')">1997</button>
                        <button class="dropdown-item" onclick="filterByYear('1996')">1996</button>
                        <button class="dropdown-item" onclick="filterByYear('1995')">1995</button>
                        <button class="dropdown-item" onclick="filterByYear('1994')">1994</button>
                        <button class="dropdown-item" onclick="filterByYear('1993')">1993</button>
                        <button class="dropdown-item" onclick="filterByYear('1992')">1992</button>
                        <button class="dropdown-item" onclick="filterByYear('1991')">1991</button>
                        <button class="dropdown-item" onclick="filterByYear('1990')">1990</button>
                    </div>
            </div>
        </div>

        <div class="table-container">

            <p> You can perform case researches using cases that have been previously 
                <span style="color: #fa9800; font-weight: bold;"> given judgements</span> by the Supreme Court.
            </p>
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
    </div>
    <script>
        function toggleSortMenu() {
            event.stopPropagation()
            let menu = document.getElementById("sortMenu");
            let isVisible = menu.style.display === "block";

            closeAllMenus();

            if (!isVisible) {
                menu.style.display = "block";
            }
        }

        function toggleYearDropdown(event) {
            event.stopPropagation();

            const dropdowns = document.querySelectorAll(".year-dropdown");
            dropdowns.forEach(drop => drop.style.display = "none");

            //get the text on the button
            const rangeText = event.target.textContent.trim();

            //take the first part of the text and map it to dropdownID
            const dropdownId = `dropdown-${rangeText.split('-')[0]}`;

            const target = document.getElementById(dropdownId);
            if (target) {
                target.style.display = "block";
            }
        }


        function togglefilterMenu() {
            event.stopPropagation();
            let menu = document.getElementById("filterMenu");
            let isVisible = menu.style.display === "block";

            closeAllMenus(); // Close both menus before toggling

            if (!isVisible) {
                menu.style.display = "block";
            }
        }
        // Close the dropdown when clicking outside
        document.addEventListener("click", function(event) {
            if (!event.target.closest('.sort-icon') && !event.target.closest('.filter-icon') && !event.target.closest('.sort-dropdown') && !event.target.closest('.filter-dropdown')) {
                closeAllMenus();
            }
        });

        function closeAllMenus() {
            document.getElementById("sortMenu").style.display = "none";
            document.getElementById("filterMenu").style.display = "none";

            const dropdowns = document.querySelectorAll(".year-dropdown");
            dropdowns.forEach(drop => drop.style.display = "none");
        }

        function sortBy(criteria) {
            fetch(`<?= ROOT ?>/PrecedentsController/sortViewOnly/${criteria}`)
                .then(response => response.text()) // Get HTML response
                .then(data => {
                    document.getElementById("precedentsTable").innerHTML = data; // Update table
                })
                .catch(error => console.error("Error:", error));

            // Hide the menu after selection
            toggleSortMenu();
        }


        function filterByYear(year) {
            fetch(`<?= ROOT ?>/PrecedentsController/filterViewOnly/${year}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById("precedentsTable").innerHTML = data;
                })
                .catch(error => console.error("Error:", error));

            closeAllMenus();
        }

        function searchPrecedents() {
            const query = document.getElementById("searchBar").value.trim();

            fetch(`<?= ROOT ?>/PrecedentsController/searchViewOnly?query=${encodeURIComponent(query)}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById("precedentsTable").innerHTML = data;
                })
                .catch(error => console.error("Error:", error));
        }
    </script>
</body>

</html>