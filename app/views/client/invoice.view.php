<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/client/payments.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/client/invoice.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include(__DIR__ . '/../seniorCounsel/component/sidebar.view.php'); ?>

    

    <div class="home-section">
       
        <div class="invoice-table">
            <div class="table-div">
                <div class="transaction-header">
                    <div>Payment Amount</div>
                    <div>Description</div>
                    <div>Sent Date</div>
                    <div>Due Date</div>
                    <div>Download</div>
                    <div>Proceed to Pay</div>
                </div>

                <?php if (!empty($sent_invoices)) : ?>
                    <?php foreach ($sent_invoices as $invoice) : ?>
                        <div class="transaction-row">
                            <div class="amount">$<?= htmlspecialchars($invoice->amount) ?></div>
                            <div class="transaction-description"><?= htmlspecialchars($invoice->paymentDesc) ?></div>
                            <div class="transaction-sent-date"><?= htmlspecialchars($invoice->sentDate ?? 'N/A') ?></div>
                            <div class="due-date"><?= htmlspecialchars($invoice->dueDate) ?></div>
                            <div>
                                <a href="<?= ROOT ?>/assets/documents/<?= htmlspecialchars($invoice->invoiceID) ?>.pdf"
                                download class="download-button">Download</a>
                            </div>
                            <a href="<?= ROOT ?>/PaymentController"><button class="pay-button"><i class='bx bx-right-arrow-circle'></i></button></a>
                            </div>
                            <?php endforeach; ?>
                            <?php else : ?>
                                <div class="transaction-row">
                                    <div colspan="6">No sent invoices found.</div>
                                </div>
                <?php endif; ?>


        </div>
    </div>

        
</body>

</html>