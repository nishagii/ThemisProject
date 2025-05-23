
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Admin Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/navBar.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

        <div class="container">
            
            <nav>
            
                <img src="<?= ROOT ?>/assets/images/themis_logo.png" alt="Logo" class="navbar-logo" />
                
                <h1>Admin Dashboard</h1>
            </nav>

            <div class="navbar-icons">
                <i class="fas fa-bell"></i>
                <a href="logout" title="Logout">
                    <i class="fas fa-cog"></i>
                </a>
                <a href="adminProfile">
                    <i class="fas fa-user-circle"></i>
                </a>
            </div>
            
        </div>

    </body>
</html>