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
                    <div>Description</div>
                    
                    <div>Due Date</div>
                    <div>Client</div>
                    <div>Amount</div>
                    <div>Invoice</div>
                    <div>Send to Client</div>
                    <div>Payment Status</div>
                </div>
                
                        <div class="invoice-row">
                            <div class="description">hfdgfyud</div>
                            
                            <div class="due-date">akhgfdigf</div>
                            <div class="client">kdjhf</div>
                            <div class="amount">lskjdhf</div>
                            <div><a href="#" download class="view-button">View Invoice</a></div>
                            <div><a href="#" download class="send-button">Send</a></div>
                            <div class="status">kdjhf</div>
                        </div>
                
            </div>
        </div>
            
    </div>

</body>

</html>
</div>