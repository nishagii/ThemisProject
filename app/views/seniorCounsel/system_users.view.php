<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/users.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>

    <div class="home-section">
        <div class="users-header">
            <h1>System Users</h1>
        </div>

        <div class="center">
            <div class="tab-container">
                <div class="tab_box">
                    <button class="tab_btn active" onclick="showTab('clients')">Clients</button>
                    <button class="tab_btn" onclick="showTab('attorneys')">Attorneys</button>
                    <button class="tab_btn" onclick="showTab('juniors')">Juniors</button>
                    <div class="line"></div>
                </div>
            </div>
            <!-- Search and Filter Section -->
            <div class="search-filter-container">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Search by name, email or phone...">
                    <button id="searchButton"><i class="fas fa-search"></i></button>
                </div>
                <div class="filter-options">
                    <select id="filterCriteria">
                        <option value="all">All</option>
                        <option value="name">Name</option>
                        <option value="email">Email</option>
                        <option value="phone">Phone</option>
                        <option value="cases">Has Cases</option>
                    </select>
                </div>
            </div>

            <!-- Clients -->
            <div class="user-container" id="clients">
                <?php if (!empty($clients)): ?>
                    <?php foreach ($clients as $client): ?>
                        <div class="user-card">
                            <div class="icon"><i class="fas fa-user"></i></div>
                            <h3><?= htmlspecialchars($client->first_name . ' ' . $client->last_name); ?></h3>
                            <p><?= htmlspecialchars($client->email); ?></p>
                            <p><?= htmlspecialchars($client->phone); ?></p>

                            <div class="cases-section">
                                <h4>Associated Cases</h4>
                                <?php if (!empty($client->cases)): ?>
                                    <div class="cases-list">
                                        <?php foreach ($client->cases as $case): ?>
                                            <div class="case-item">
                                                <span class="case-number"><?= htmlspecialchars($case->case_number); ?></span>
                                                <span class="case-court"><?= isset($case->court) ? htmlspecialchars($case->court) : ''; ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p class="no-cases">No cases found</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No clients found.</p>
                <?php endif; ?>
            </div>

            <!-- Attorneys -->
            <div class="user-container" id="attorneys" style="display: none;">
                <?php foreach ($attorneys as $attorney): ?>
                    <div class="user-card">
                        <div class="icon"><i class="fas fa-user-tie"></i></div>
                        <h3><?= htmlspecialchars($attorney->first_name . ' ' . $attorney->last_name); ?></h3>
                        <p><?= htmlspecialchars($attorney->email); ?></p>
                        <p><?= htmlspecialchars($attorney->phone); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Juniors -->
            <div class="user-container" id="juniors" style="display: none;">
                <?php foreach ($juniors as $junior): ?>
                    <div class="user-card">
                        <div class="icon"><i class="fas fa-user-graduate"></i></div>
                        <h3><?= htmlspecialchars($junior->first_name . ' ' . $junior->last_name); ?></h3>
                        <p><?= htmlspecialchars($junior->email); ?></p>
                        <p><?= htmlspecialchars($junior->phone); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Cases Modal -->
    <div id="casesModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Client Cases</h2>
            <div id="casesContent">
                <div id="cases-content">
                    <div class="loading">Loading...</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab switch
        // Function to handle tab switching
        function showTab(tabId) {
            // Hide all user containers
            const tabs = document.querySelectorAll('.user-container');
            tabs.forEach(tab => tab.style.display = 'none');

            // Show the selected tab
            const selectedTab = document.getElementById(tabId);
            if (selectedTab) {
                selectedTab.style.display = 'flex';
            }

            // Update the active button
            const buttons = document.querySelectorAll('.tab_btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Move the line under the active button
            moveLineToActiveButton();

            // Reset search and filter
            const searchInput = document.getElementById('searchInput');
            const filterCriteria = document.getElementById('filterCriteria');
            if (searchInput && filterCriteria) {
                searchInput.value = '';
                filterCriteria.value = 'all';

                // Show all cards in the selected tab
                const userCards = document.querySelectorAll(`#${tabId} .user-card`);
                userCards.forEach(card => {
                    card.style.display = 'block';
                });

                // Remove any "no results" messages
                const noResultsMsg = document.querySelector(`#${tabId} .no-results`);
                if (noResultsMsg) {
                    noResultsMsg.remove();
                }
            }
        }


        // Line animation
        function moveLineToActiveButton() {
            const activeButton = document.querySelector('.tab_btn.active');
            const line = document.querySelector('.line');
            const btnBounds = activeButton.getBoundingClientRect();
            const containerBounds = activeButton.parentElement.getBoundingClientRect();

            const leftPosition = btnBounds.left - containerBounds.left;
            line.style.left = `${leftPosition}px`;
            line.style.width = `${btnBounds.width}px`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            moveLineToActiveButton();
            window.addEventListener('resize', moveLineToActiveButton);

            const casesModal = document.getElementById('casesModal');
            const closeModal = document.querySelector('.close-modal');
            const casesContent = document.getElementById('cases-content');

            document.querySelectorAll('.view-all-cases').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-userid');
                    casesModal.style.display = 'block';
                    casesContent.innerHTML = '<div class="loading">Loading...</div>';

                    fetch(`<?= ROOT ?>/users/getClientCases/${userId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success && data.cases.length > 0) {
                                let html = '<table class="cases-table">';
                                html += '<thead><tr><th>Case Number</th><th>Court</th><th>Attorney</th><th>Junior Counsel</th></tr></thead>';
                                html += '<tbody>';

                                data.cases.forEach(caseItem => {
                                    html += `<tr>
                                        <td>${caseItem.case_number}</td>
                                        <td>${caseItem.court || 'N/A'}</td>
                                        <td>${caseItem.attorney_name || 'N/A'}</td>
                                        <td>${caseItem.junior_counsel_name || 'N/A'}</td>
                                    </tr>`;
                                });

                                html += '</tbody></table>';
                                casesContent.innerHTML = html;
                            } else {
                                casesContent.innerHTML = '<p>No cases found for this client.</p>';
                            }
                        })
                        .catch(error => {
                            casesContent.innerHTML = '<p>Error: Could not load case details.</p>';
                            console.error('Error:', error);
                        });
                });
            });

            if (closeModal) {
                closeModal.addEventListener('click', function() {
                    casesModal.style.display = 'none';
                });
            }

            window.addEventListener('click', function(event) {
                if (event.target === casesModal) {
                    casesModal.style.display = 'none';
                }
            });
        });

        // Search and Filter Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');
            const filterCriteria = document.getElementById('filterCriteria');

            // Function to perform search and filtering
            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const filterValue = filterCriteria.value;
                const activeTab = document.querySelector('.tab_btn.active').textContent.toLowerCase();

                // Get all user cards in the active tab
                const userCards = document.querySelectorAll(`#${activeTab} .user-card`);
                let resultsFound = false;

                userCards.forEach(card => {
                    let shouldShow = false;

                    // Get text content from relevant elements
                    const name = card.querySelector('h3').textContent.toLowerCase();
                    const email = card.querySelector('p:nth-of-type(1)').textContent.toLowerCase();
                    const phone = card.querySelector('p:nth-of-type(2)')?.textContent.toLowerCase() || '';
                    const hasCases = card.querySelector('.cases-section') ?
                        !card.querySelector('.no-cases') : false;

                    // Apply filter based on criteria
                    if (filterValue === 'all') {
                        shouldShow = name.includes(searchTerm) ||
                            email.includes(searchTerm) ||
                            phone.includes(searchTerm);
                    } else if (filterValue === 'name') {
                        shouldShow = name.includes(searchTerm);
                    } else if (filterValue === 'email') {
                        shouldShow = email.includes(searchTerm);
                    } else if (filterValue === 'phone') {
                        shouldShow = phone.includes(searchTerm);
                    } else if (filterValue === 'cases') {
                        shouldShow = hasCases && (searchTerm === '' ||
                            name.includes(searchTerm) ||
                            email.includes(searchTerm) ||
                            phone.includes(searchTerm));
                    }

                    // Show or hide the card
                    if (shouldShow) {
                        card.style.display = 'block';
                        resultsFound = true;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show "no results" message if needed
                const noResultsMsg = document.querySelector(`#${activeTab} .no-results`);
                if (!resultsFound) {
                    if (!noResultsMsg) {
                        const msg = document.createElement('p');
                        msg.className = 'no-results';
                        msg.textContent = 'No users found matching your search criteria.';
                        document.getElementById(activeTab).appendChild(msg);
                    }
                } else if (noResultsMsg) {
                    noResultsMsg.remove();
                }
            }

            // Event listeners
            searchButton.addEventListener('click', performSearch);

            searchInput.addEventListener('keyup', function(event) {
                if (event.key === 'Enter') {
                    performSearch();
                }
            });

            filterCriteria.addEventListener('change', performSearch);

            // Add event listener to tab buttons to reset search when changing tabs
            document.querySelectorAll('.tab_btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    // Clear search input and reset filter when changing tabs
                    searchInput.value = '';
                    filterCriteria.value = 'all';

                    // Remove any "no results" messages
                    document.querySelectorAll('.no-results').forEach(msg => msg.remove());

                    // Show all cards in the newly selected tab
                    setTimeout(() => {
                        const activeTab = this.textContent.toLowerCase();
                        const userCards = document.querySelectorAll(`#${activeTab} .user-card`);
                        userCards.forEach(card => {
                            card.style.display = 'block';
                        });
                    }, 100); // Small delay to ensure tab switch completes first
                });
            });
        });
    </script>

</body>

</html>