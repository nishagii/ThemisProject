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

                <!-- Updated transactions -->
                <div class="transaction-row">
                    <div class="amount">$250</div>
                    <div class="transaction-description">Invoice for Legal Consultation</div>
                    <div class="transaction-sent-date">2025-04-10</div>
                    <div class="due-date">2025-04-17</div>
                    <div><a href="<?= ROOT ?>/assets/documents/invoice1.pdf" download class="download-button">Download</a></div>
                    <button class="pay-button"><i class='bx bx-right-arrow-circle'></i></button>

                </div>

                <div class="transaction-row">
                    <div class="amount">$75</div>
                    <div class="transaction-description">Court Filing Receipt</div>
                    <div class="transaction-sent-date">2025-04-05</div>
                    <div class="due-date">2025-04-12</div>
                    <div><a href="<?= ROOT ?>/assets/documents/filing_receipt.pdf" download class="download-button">Download</a></div>
                    <button class="pay-button"><i class='bx bx-right-arrow-circle'></i></button>
                </div>

                <div class="transaction-row">
                    <div class="amount">$120</div>
                    <div class="transaction-description">Evidence Document</div>
                    <div class="transaction-sent-date">2025-03-30</div>
                    <div class="due-date">2025-04-06</div>
                    <div><a href="<?= ROOT ?>/assets/documents/evidence_doc.pdf" download class="download-button">Download</a></div>
                    <button class="pay-button"><i class='bx bx-right-arrow-circle'></i></button>
                </div>
            </div>

        </div>
    </div>

        
</body>

</html>