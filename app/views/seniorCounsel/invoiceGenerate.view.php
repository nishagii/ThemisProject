<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice - <?= htmlspecialchars($invoiceData['invoiceNumber']) ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            padding: 20px;
            color: #333;
        }

        .invoice-box {
            max-width: 850px;
            margin: auto;
            background: linear-gradient(135deg, rgb(240, 243, 247), #ffffff);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        }

        .header {
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-info {
            text-align: left;
        }

        .logo {
            text-align: right;
        }

        .logo img {
            max-height: 100px;
            max-width: 100%;
            display: block;
            margin: 0;
        }

        .header h2 {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
        }

        .header p {
            font-size: 14px;
            color: #6b7280;
            margin-top: 4px;
        }

        .details, .payment-info {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .details td, .payment-info th, .payment-info td {
            padding: 16px;
            border: 1px solid #e5e7eb;
            font-size: 14px;
        }

        .payment-info th {
            background: #f3f4f6;
            font-weight: 600;
            text-align: left;
            color: #374151;
        }

        .payment-info td {
            text-align: right;
            color: #4b5563;
        }

        .payment-info td:first-child {
            text-align: left;
        }

        .total-row td {
            font-size: 16px;
            font-weight: 700;
            color: rgb(11, 38, 112);
        }

        .btn {
            display: block;
            width: 100%;
            max-width: 200px;
            margin: 15px auto 0;
            padding: 12px 20px;
            background: rgb(11, 38, 112);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            text-align: center;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        @media (max-width: 600px) {
            .details td, .payment-info th, .payment-info td {
                font-size: 12px;
                padding: 10px;
            }
        }

        .back {
            display: flex;
            justify-content: flex-start; /* This pushes the button to the left */
            margin-top: 20px;
        }

        .btn-back {
            background-color: #1d4ed8;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-back:hover {
            background-color: #143db8;
        }
    </style>
</head>

<body>
    <div class="back">
        <button class="btn-back" onclick="window.history.back()">Go Back</button>
    </div>
    <div class="invoice-box">
        <div class="header">
            <div class="header-info">
                <h1>THEMIS</h1>
                <h4>INVOICE</h4>
                <p><strong>Invoice #: </strong><?= htmlspecialchars($invoiceData['invoiceNumber']) ?></p>
                <p><strong>Due: </strong><?= htmlspecialchars($invoiceData['dueDate']) ?></p>
            </div>
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/themis_logo.png">
            </div>
        </div>

        <table class="details">
            <tr>
                <td><strong>Invoice to:</strong> <?= htmlspecialchars($invoiceData['client']->first_name) ?></td>
                <td><strong>Address:</strong> <?= htmlspecialchars($invoiceData['client']->email) ?></td>
            </tr>
            <tr>
                <td><strong>Case ID:</strong> <?= htmlspecialchars($invoiceData['caseID']) ?></td>
                <td><strong>Comments:</strong> <?= htmlspecialchars($invoiceData['comments'] ?? 'None') ?></td>
            </tr>
        </table>

        <table class="payment-info">
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
            <tr>
                <td><?= htmlspecialchars($invoiceData['paymentDesc']) ?></td>
                <td>$<?= number_format((float)$invoiceData['amount'], 2) ?></td>
            </tr>
            <tr class="total-row">
                <td>Total Amount</td>
                <td>$<?= number_format((float)$invoiceData['amount'], 2) ?></td>
            </tr>
        </table>

        <button class="btn" onclick="window.print()">Print / Save as PDF</button>
    </div>
</body>

</html>
