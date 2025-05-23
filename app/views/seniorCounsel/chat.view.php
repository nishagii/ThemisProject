<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/chat.css" />
</head>
<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>

    <div class="home-section">
        <div class="chat">
        <div id="inner_left_panel">
            <!-- Content will be loaded here -->
                <div class="icon">
                    <i class="bx bx-plus-circle" id="addButton"></i>
                </div>
                
                <div class="message">
                    <h4>Messages</h4>
                    
                </div>
          </div>

          <div id="inner_right_panel">
            <!-- Chat messages will appear here -->
            
            <!-- Message input area -->
            <div class="chat-messages">
            <!-- Messages go here -->
        </div>
        <div class="message-input">
            <!-- Input area content -->
        </div>
            
          </div>

        </div>
    </div>

    <!-- Pass ROOT to the JavaScript -->
    <script>
        // Define ROOT variable for use in chat.js
        const ROOT = "<?= ROOT ?>";
    </script>

<script>
    // Convert PHP array to JavaScript JSON object
    const users = <?= json_encode($users); ?>;

    
    // if (user && user.id) {
    //     alert("User ID: " + user.id); // Display user ID in an alert
    // } else {
    //     alert("No user session found.");
    // }

    // Pass user data to chat.js (specifically user ID)
    const userId = <?= json_encode($user['id'] ?? null); ?>;

    // Optionally, check if user ID exists
    if (userId) {
        console.log("User ID: " + userId); // Optional: log user ID to the console for verification
    }
</script>
    <!-- Include chat.js, where ROOT is now accessible -->
    <script src="<?= ROOT ?>/assets/js/chat.js"> </script>
</body>
</html>
