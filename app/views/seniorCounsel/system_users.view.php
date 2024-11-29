<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/users.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/users.css">

</head>

<body>

    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
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

        <!-- User Cards -->
        <div class="user-container" id="clients">
            <!-- Example user card for clients -->
            <div class="user-card">
                <div class="icon"><i class="fas fa-user"></i></div>
                <h3>Nadhiya Nashath</h3>
                <p>nadhiya@example.com</p>
            </div>
            <div class="user-card">
                <div class="icon"><i class="fas fa-user"></i></div>
                <h3>Nishagi Jeewantha</h3>
                <p>nish@example.com</p>
            </div>
            <div class="user-card">
                <div class="icon"><i class="fas fa-user"></i></div>
                <h3>Sawani Vihanga</h3>
                <p>sawani@example.com</p>
            </div>
            <div class="user-card">
                <div class="icon"><i class="fas fa-user"></i></div>
                <h3>Chamath Abeysinghe</h3>
                <p>chamath@example.com</p>
            </div>
            <div class="user-card">
                <div class="icon"><i class="fas fa-user"></i></div>
                <h3>John Doe</h3>
                <p>john.doe@example.com</p>
            </div>
            <div class="user-card">
                <div class="icon"><i class="fas fa-user"></i></div>
                <h3>Doe</h3>
                <p>doe@example.com</p>
            </div>
            <div class="user-card">
                <div class="icon"><i class="fas fa-user"></i></div>
                <h3>Mark</h3>
                <p>Mark.doe@example.com</p>
            </div>
        </div>

        <div class="user-container" id="attorneys" style="display: none;">
            <!-- Example user card for attorneys -->
            <div class="user-card">
                <div class="icon"><i class="fas fa-user-tie"></i></div>
                <h3>Jane Smith</h3>
                <p>jane.smith@example.com</p>
            </div>

            <div class="user-card">
                <div class="icon"><i class="fas fa-user-tie"></i></div>
                <h3>Smith</h3>
                <p>smith@example.com</p>
            </div>

            <div class="user-card">
                <div class="icon"><i class="fas fa-user-tie"></i></div>
                <h3>Jaya</h3>
                <p>jaya@example.com</p>
            </div>

            <div class="user-card">
                <div class="icon"><i class="fas fa-user-tie"></i></div>
                <h3>Sunny</h3>
                <p>sunny@example.com</p>
            </div>
        </div>

        <div class="user-container" id="juniors" style="display: none;">
            <!-- Example user card for juniors -->
            <div class="user-card">
                <div class="icon"><i class="fas fa-user-graduate"></i></div>
                <h3>Emma Brown</h3>
                <p>emma.brown@example.com</p>
            </div>
            <div class="user-card">
                <div class="icon"><i class="fas fa-user-graduate"></i></div>
                <h3>Em</h3>
                <p>em@example.com</p>
            </div>
        </div>
    </div>

    <script>
        // JavaScript for switching tabs
        function showTab(tabId) {
            // Hide all user containers
            const tabs = document.querySelectorAll('.user-container');
            tabs.forEach(tab => tab.style.display = 'none');

            // Remove active class from all buttons
            const buttons = document.querySelectorAll('.tab_btn');
            buttons.forEach(btn => btn.classList.remove('active'));

            // Show the selected tab and add active class to the clicked button
            document.getElementById(tabId).style.display = 'flex';
            event.target.classList.add('active');
        }

        // Function to position the line under the active button
        function moveLineToActiveButton() {
            const activeButton = document.querySelector('.tab_btn.active');
            const line = document.querySelector('.line');
            const btnBounds = activeButton.getBoundingClientRect();
            const containerBounds = activeButton.parentElement.getBoundingClientRect();

            // Calculate the position and size of the line
            const leftPosition = btnBounds.left - containerBounds.left;
            line.style.left = `${leftPosition}px`;
            line.style.width = `${btnBounds.width}px`;
        }

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
        }

        // Initialize the line on page load
        document.addEventListener('DOMContentLoaded', moveLineToActiveButton);

        // Adjust the line position when the window is resized
        window.addEventListener('resize', moveLineToActiveButton);
    </script>

</body>

</html>

<!-- 
To dynamically display users, fetch data from the backend (using PHP, for example) and loop through it. -->
<!-- 
<div class="user-container" id="clients">
    <?php foreach ($clients as $client): ?>
        <div class="user-card">
            <div class="icon"><i class="fas fa-user"></i></div>
            <h3><?= htmlspecialchars($client['username']); ?></h3>
            <p><?= htmlspecialchars($client['email']); ?></p>
        </div>
    <?php endforeach; ?>
</div> -->