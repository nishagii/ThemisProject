
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Admin Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/security.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<?php include('component/navBar.view.php'); ?>
<?php include('component/sideBar.view.php'); ?>

<div class="flex">
   
   <div class="div-1">
       <table class="login-table">
           <h3>Login Attempts</h3>
           <thead>
               <tr>
                   <th>Username</th>
                   <th>Date & Time</th>
                   <th>IP Address</th>
                   <th>No of Attempts</th>
                   <th>Status</th>
                   <th>Remarks</th>
               </tr>
           </thead>
           <tbody>
               <tr>
                   <td>user123</td>
                   <td>2024-11-15 10:15 AM</td>
                   <td>192.168.1.10</td>
                   <td>1</td>
                   <td class="status-success">Success</td>
                   <td>Login successful</td>
               </tr>
               <tr>
                   <td>user456</td>
                   <td>2024-11-15 10:30 AM</td>
                   <td>192.168.1.10</td>
                   <td>1</td>
                   <td class="status-failed">Failed</td>
                   <td>Incorrect password</td>
               </tr>
               <tr>
                   <td>user123</td>
                   <td>2024-11-15 10:45 AM</td>
                   <td>192.168.1.10</td>
                   <td>1</td>
                   <td class="status-locked">Account Locked</td>
                   <td>Too many failed attempts</td>
               </tr>
               <tr>
                   <td>user456</td>
                   <td>2024-11-15 10:30 AM</td>
                   <td>192.168.1.10</td>
                   <td>1</td>
                   <td class="status-failed">Failed</td>
                   <td>Incorrect password</td>
               </tr>
               <tr>
                   <td>user123</td>
                   <td>2024-11-15 10:45 AM</td>
                   <td>192.168.1.10</td>
                   <td>1</td>
                   <td class="status-locked">Account Locked</td>
                   <td>Too many failed attempts</td>
               </tr>
               <tr>
                   <td>user456</td>
                   <td>2024-11-15 10:30 AM</td>
                   <td>192.168.1.10</td>
                   <td>1</td>
                   <td class="status-failed">Failed</td>
                   <td>Incorrect password</td>
               </tr>
               <tr>
                   <td>user123</td>
                   <td>2024-11-15 10:45 AM</td>
                   <td>192.168.1.10</td>
                   <td>1</td>
                   <td class="status-locked">Account Locked</td>
                   <td>Too many failed attempts</td>
               </tr>
               <!-- Add more rows as needed -->
           </tbody>
       </table>
   </div>
   <div class="div-2">
       <div class="box-1">
           <h3>Session Report</h3>
           <table class="login-table">
               <thead>
                   <tr>
                       <th>User ID</th>
                       <th>Session ID</th>
                       <th>Start Time</th>
                       <th>End Time</th>
                       <th>Duration</th>
                       <th>Status</th>
                   </tr>
               </thead>
               <tbody>
                   <!-- Hardcoded session data -->
                   <tr>
                       <td>101</td>
                       <td>SESSION12345</td>
                       <td>2024-11-16 10:00:00</td>
                       <td>2024-11-16 10:45:00</td>
                       <td>45 minutes</td>
                       <td>Terminated</td>
                   </tr>
                   <tr>
                       <td>102</td>
                       <td>SESSION67890</td>
                       <td>2024-11-16 11:00:00</td>
                       <td>2024-11-16 11:30:00</td>
                       <td>30 minutes</td>
                       <td>Terminated</td>
                   </tr>
                   <tr>
                       <td>103</td>
                       <td>SESSION24680</td>
                       <td>2024-11-16 11:15:00</td>
                       <td>Ongoing</td>
                       <td>N/A</td>
                       <td>Active</td>
                   </tr>
               </tbody>
           </table>
       </div>
       
       <div class="box-2">
           <h3>Encryption Status Report</h3>
           
           <table class="login-table">
               <thead>
                   <tr>
                       <th>Aspect</th>
                       <th>Status</th>
                   </tr>
               </thead>
               <tbody>
                   <tr>
                       <td>Data Encryption</td>
                       <td>Enabled (AES-256)</td>
                   </tr>
                   <tr>
                       <td>Key Management</td>
                       <td>Secure (HSM Integrated)</td>
                   </tr>
                   <tr>
                       <td>Transmission Security</td>
                       <td>Enabled (TLS 1.3)</td>
                   </tr>
                   <tr>
                       <td>Integrity Check</td>
                       <td>Passed (SHA-256)</td>
                   </tr>
               </tbody>
           </table>
       </div>
       
   </div>
</div>

</body>
</html>