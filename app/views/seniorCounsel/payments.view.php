<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/payments.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/js/seniorCounsel/payments.js">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>


<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>

    <div class="home-section">
        
        <div class="outline">
            <div class="badge">
                <div class="text">
                <i class='bx bx-file'></i>
                <span class="prompt">Click Here to Generate an Invoice for the Client</span>
                </div>
                <button class="button" onclick="window.location.href='<?= ROOT ?>/invoice'">CREATE INVOICE</button>
            </div>
        </div>

        <div class="invoice-card">

            
            <div class="invoice-container">

                <div class="payment-section">
                        <button class="payment-button">
                            <i class='bx bx-file'></i> <p>View Paid Receipts</p>
                        </button>
                </div>
                
                <div class="invoice-header">
                   
                    
                    <div>Due Date</div>
                    <div>Client</div>
                    <div>Amount</div>
                    <div>Invoice</div>
                    <div>Send to Client</div>
                    <div>Payment Status</div>
                </div>
                
                <?php if (!empty($invoices)): ?>
                    <?php foreach ($invoices as $invoice): ?>
                        <div class="invoice-row">
                            
                            <div class="due-date"><?= htmlspecialchars($invoice->dueDate) ?></div>
                            <div class="client"><?= htmlspecialchars($invoice->clientName) ?></div>
                            <div class="amount">Rs. <?= htmlspecialchars($invoice->amount) ?></div>
                            <div>
                                <a href="<?= ROOT ?>/invoices/view/<?= $invoice->invoiceID ?>" class="view-button">View</a>
                            </div>
                            <div>
                                <a href="<?= ROOT ?>/invoices/send/<?= $invoice->invoiceID ?>" class="send-button">Send</a>
                            </div>
                            <div class="status"><?= $invoice->sent ? 'Sent' : 'Pending' ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align:center; margin-top: 20px;">No invoices found.</p>
                <?php endif; ?>

                
            </div>
        </div>
            
    </div>

</body>

</html>
</div>