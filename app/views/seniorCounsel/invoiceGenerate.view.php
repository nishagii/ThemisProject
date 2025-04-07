<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice - <?= htmlspecialchars($invoiceData['invoiceID']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    
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
            background: #143db8;
        }

        @media (max-width: 600px) {
            .details td, .payment-info th, .payment-info td {
                font-size: 12px;
                padding: 10px;
            }
        }

        .back {
            display: flex;
            justify-content: flex-start;
            margin-top: 20px;
        }

        .btn-back {
            background-color: rgb(11, 38, 112);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-back:hover {
            background-color: #143db8;
        }

        /* Print-specific styles */
        @media print {
            body * {
                visibility: hidden;
            }

            .invoice-box, .invoice-box * {
                visibility: visible;
            }

            .invoice-box {
                position: absolute;
                left: 0;
                top: 0;
                right: 0;
                bottom: 0;
            }

            .back {
                display: none;
            }

            .btn {
                display: none;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="back">
        <button class="btn-back" onclick="window.history.back()">
            <i class='bx bx-arrow-back'></i> <!-- Boxicons arrow-back icon -->
        </button>
    </div>

    <div class="invoice-box">
        <div class="header">
            <div class="header-info">
                <h1>THEMIS</h1>
                <h4>INVOICE</h4>
                <p><strong>Invoice #: </strong><?= htmlspecialchars($invoiceData['invoiceID']) ?></p>
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

    </div>
    <div class="back">
        <button class="btn" onclick="window.print()">Print / Save as PDF</button>
        <button class="btn send-btn" data-invoice-id="<?= htmlspecialchars($invoiceData['invoiceID'] ?? '') ?>">Send Invoice</button>
        
    </div>

   
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sendBtn = document.querySelector('.send-btn');
            
            if (sendBtn) {
                sendBtn.addEventListener('click', function() {
                    // Get the invoice ID - you'll need to add this as a data attribute to the button
                    const invoiceId = this.getAttribute('data-invoice-id');
                    console.log("Invoice ID from button:", invoiceId); // Debug log
                    
                    if (!invoiceId) {
                        
                            return;Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'Invoice ID is missing.',
                        });
                    return;
                    }

                    fetch(`<?= ROOT ?>/invoice/markInvoiceAsSent/${invoiceId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Invoice Sent!',
                            text: 'The invoice was successfully sent.',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        sendBtn.textContent = 'Invoice Sent';
                        sendBtn.disabled = true;
                        } else {
                            Swal.fire({
                            icon: 'error',
                            title: 'Failed!',
                            text: data.message || 'Failed to mark invoice as sent.',
                        });
                        }
                    })
                    .catch(error => {
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while sending the invoice.',
                        });
                    });
                });
            }
        });
    </script>
</body>

</html>
