<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Admin Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/loginactivity.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- this is imported to use icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php include('component/navBar.view.php'); ?>
    <?php include('component/sideBar.view.php'); ?>

    <div class="home-section">
        <div class="login-container">
            <h2>Admin Login Activity</h2>
            <table>
                <thead>
                    <tr>
                        <th>Logged In At</th>
                        <th>User Name</th>
                        <th>Status</th>
                        <th>User ID</th>
                        <th>IP Address</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nov 11, 2023 07:24:33 AM</td>
                        <td>admin1</td>
                        <td class="status success">SUCCESS</td>
                        <td>1</td>
                        <td>192.168.1.10</td>
                        <td>Admin</td>
                    </tr>
                    <tr>
                        <td>Nov 11, 2023 06:55:22 AM</td>
                        <td>precedent1</td>
                        <td class="status failed">FAILED</td>
                        <td>2</td>
                        <td>192.168.1.11</td>
                        <td>Precedent</td>
                    </tr>
                    <tr>
                        <td>Nov 11, 2023 05:30:18 AM</td>
                        <td>client1</td>
                        <td class="status failed">FAILED</td>
                        <td>3</td>
                        <td>192.168.1.12</td>
                        <td>Client</td>
                    </tr>
                    <tr>
                        <td>Nov 11, 2023 04:50:11 AM</td>
                        <td>admin2</td>
                        <td class="status success">SUCCESS</td>
                        <td>4</td>
                        <td>192.168.1.13</td>
                        <td>Admin</td>
                    </tr>
                    <tr>
                        <td>Nov 11, 2023 04:15:45 AM</td>
                        <td>precedent2</td>
                        <td class="status success">SUCCESS</td>
                        <td>5</td>
                        <td>192.168.1.14</td>
                        <td>Precedent</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>