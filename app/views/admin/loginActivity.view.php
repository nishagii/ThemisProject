<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Activity</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .status {
            font-weight: bold;
            text-align: center;
            padding: 8px;
            border-radius: 4px;
        }
        .status.success {
            color: #fff;
            background-color: #4CAF50;
        }
        .status.failed {
            color: #fff;
            background-color: #F44336;
        }
    </style>
</head>
<body>
    <div class="container">
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
</body>
</html>
