<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS - Salary Payment</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/template.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>

    <div class="table-container">
        <h2>Salary Payments</h2>
        <table class="template-table">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Date</th>
                    <th>Amount (LKR)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>001</td>
                    <td>2024-10-01</td>
                    <td>51,500</td>
                    <td>Paid</td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>2024-11-01</td>
                    <td>15,500</td>
                    <td>Paid</td>
                </tr>
                <tr>
                    <td>003</td>
                    <td>2024-12-01</td>
                    <td>15,500</td>
                    <td>Pending</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
