<!-- this is payment history page code. i removed it beacause the payment integration. later this will be helpfull to me -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/client/payments.css">
</head>

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>

    <div class="payment-container">
        <!-- Summary Section -->
        <div class="summary-section">
            <div class="summary-card">
                <div class="icon-wrapper">
                    <i class="fas fa-wallet"></i>
                </div>
                <h2>Total Payments</h2>
                <p>Rs. <span id="total-payments">4500</span></p>
            </div>
            <div class="summary-card">
                <div class="icon-wrapper">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <h2>Due Payments</h2>
                <p>Rs. <span id="due-payments">2000</span></p>
            </div>
            <div class="summary-card">
                <div class="icon-wrapper">
                    <i class="fas fa-clock"></i>
                </div>
                <h2>Last Payment</h2>
                <p>Rs. <span id="due-payments">1500</span></p>
            </div>
        </div>

        <!-- Payment Cards Section -->
        <div class="payments-section">
            <h1>Payment History</h1>
            <div class="cards-container">
                <div class="payment-card">
                    <div class="card-header">
                        <i class="fas fa-calendar-check"></i>
                        <span>2024-11-20</span>
                    </div>
                    <div class="card-body">
                        <p>Paid Amount: <strong>Rs.500</strong></p>
                        <p>Paid To: <strong>Lawyer A</strong></p>
                    </div>
                </div>

                <div class="payment-card">
                    <div class="card-header">
                        <i class="fas fa-calendar-check"></i>
                        <span>2024-11-15</span>
                    </div>
                    <div class="card-body">
                        <p>Paid Amount: <strong>Rs.1000</strong></p>
                        <p>Paid To: <strong>Lawyer B</strong></p>
                    </div>
                </div>
                <div class="payment-card">
                    <div class="card-header">
                        <i class="fas fa-calendar-check"></i>
                        <span>2024-11-15</span>
                    </div>
                    <div class="card-body">
                        <p>Paid Amount: <strong>Rs.1000</strong></p>
                        <p>Paid To: <strong>Lawyer B</strong></p>
                    </div>
                </div>
                <div class="payment-card">
                    <div class="card-header">
                        <i class="fas fa-calendar-check"></i>
                        <span>2024-11-15</span>
                    </div>
                    <div class="card-body">
                        <p>Paid Amount: <strong>Rs.1000</strong></p>
                        <p>Paid To: <strong>Lawyer B</strong></p>
                    </div>
                </div>
                <div class="payment-card">
                    <div class="card-header">
                        <i class="fas fa-calendar-check"></i>
                        <span>2024-11-15</span>
                    </div>
                    <div class="card-body">
                        <p>Paid Amount: <strong>Rs.1000</strong></p>
                        <p>Paid To: <strong>Lawyer B</strong></p>
                    </div>
                </div>
                <div class="payment-card">
                    <div class="card-header">
                        <i class="fas fa-calendar-check"></i>
                        <span>2024-11-15</span>
                    </div>
                    <div class="card-body">
                        <p>Paid Amount: <strong>Rs.1000</strong></p>
                        <p>Paid To: <strong>Lawyer B</strong></p>
                    </div>
                </div>
                <div class="payment-card">
                    <div class="card-header">
                        <i class="fas fa-calendar-check"></i>
                        <span>2024-11-15</span>
                    </div>
                    <div class="card-body">
                        <p>Paid Amount: <strong>Rs.1000</strong></p>
                        <p>Paid To: <strong>Lawyer B</strong></p>
                    </div>
                </div>
                <div class="payment-card">
                    <div class="card-header">
                        <i class="fas fa-calendar-check"></i>
                        <span>2024-11-15</span>
                    </div>
                    <div class="card-body">
                        <p>Paid Amount: <strong>Rs.1000</strong></p>
                        <p>Paid To: <strong>Lawyer B</strong></p>
                    </div>
                </div>
                <div class="payment-card">
                    <div class="card-header">
                        <i class="fas fa-calendar-check"></i>
                        <span>2024-11-15</span>
                    </div>
                    <div class="card-body">
                        <p>Paid Amount: <strong>Rs.1000</strong></p>
                        <p>Paid To: <strong>Lawyer B</strong></p>
                    </div>
                </div>
                <div class="payment-card">
                    <div class="card-header">
                        <i class="fas fa-calendar-check"></i>
                        <span>2024-11-15</span>
                    </div>
                    <div class="card-body">
                        <p>Paid Amount: <strong>Rs.1000</strong></p>
                        <p>Paid To: <strong>Lawyer B</strong></p>
                    </div>
                </div>
                <!-- Add more payment cards as needed -->
            </div>
        </div>
    </div>
</body>

</html>