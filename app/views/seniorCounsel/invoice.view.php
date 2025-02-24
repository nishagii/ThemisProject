<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/invoice.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>


<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>

    <div class="home-section">
        
        <div class="form-container">
            <form action="generate_invoice.php" method="POST">

            <div class="bill-to">
                    <div class="heading">
                        <h3>Bill to:</h3>
                    </div>

                    <!-- Customer name dropdown -->
                    <label>Client Name: 
                        <select name="customer_name" required>
                            <?php 
                            // Example code for generating dropdown
                            // while($row = mysqli_fetch_assoc($result)) {
                            //     echo "<option value='" . $row['customer_name'] . "'>" . $row['customer_name'] . "</option>";
                            // }
                            ?>
                            <option value="Customer 1">Customer 1</option>
                            <option value="Customer 2">Customer 2</option>
                            <option value="Customer 3">Customer 3</option>
                        </select>
                    </label>

                    <!-- Case number dropdown -->
                    <label>Case Number: 
                        <select name="case_number" required>
                            <?php 
                            // Example code for generating dropdown
                            // while($row = mysqli_fetch_assoc($caseResult)) {
                            //     echo "<option value='" . $row['case_number'] . "'>" . $row['case_number'] . "</option>";
                            // }
                            ?>
                            <option value="Case 001">Case 001</option>
                            <option value="Case 002">Case 002</option>
                            <option value="Case 003">Case 003</option>
                        </select>
                    </label>

                    <!-- Comments section -->
                    <label>Comments:
                        <textarea name="comments" rows="4" cols="50" placeholder="Enter any additional comments here..."></textarea>
                    </label>
                </div>

                
                <div class="invoice-info">
                    <div class="heading">
                    <h3>Invoice Information</h3>
                    </div>

                    <label>Payment Description:
                        <textarea name="payment_description" rows="3" placeholder="Enter payment details..." required></textarea>
                    </label>

                    <label>Payment Amount:
                        <input type="number" name="payment_amount" placeholder="Enter amount" step="0.01" min="0" required>
                    </label>

                    <label>Payment Due Date:
                        <input type="date" name="payment_due" required>
                    </label>

                    <button type="submit">Generate Invoice</button>
                </div>
                
            
                
                
            </form>
        </div>
            
    </div>

</body>

</html>
</div>