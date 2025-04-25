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
        <form action="<?= ROOT ?>/invoice/createInvoice" method="POST">
    <div class="bill-to">
        <div class="heading">
            <h3>Bill to:</h3>
        </div>

        <label>Client Name:
            <select name="clientID" required>
                <?php foreach ($client as $c): ?>
                    <option value="<?= htmlspecialchars($c->id) ?>">
                        <?= htmlspecialchars($c->first_name . ' ' . $c->last_name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div id="client-error" class="error-message"></div>
        </label>

        <label>Case Number:
            <select name="caseID" id="caseID" required>
                <option value="">-- Select a case --</option>
            </select>
            <div id="case-error" class="error-message"></div>
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
            <textarea name="paymentDesc" rows="3" placeholder="Enter payment details..."></textarea>
            <div id="payment-description-error" class="error-message"></div>
        </label>

        <label>Payment Amount:
            <input type="number" name="amount" placeholder="Enter amount" step="0.01" min="0">
            <div id="payment-amount-error" class="error-message"></div>
        </label>

        <label>Payment Due Date:
            <input type="date" name="dueDate" min="<?= date('Y-m-d'); ?>">
            <div id="payment-due-error" class="error-message"></div>
        </label>

        <button type="submit">Generate Invoice</button>
    </div>
</form>

        </div>


    </div>

</body>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            // Clear previous error messages
            document.querySelectorAll('.error-message').forEach(function(msg) {
                msg.innerHTML = '';
            });

            let valid = true;

            // Check Client Name
            const clientName = document.querySelector('[name="clientID"]');
            if (!clientName.value) {
                document.getElementById('client-error').innerHTML = 'Client name is required.';
                valid = false;
            }

            // Check Case Number
            const caseNumber = document.querySelector('[name="caseID"]');
            if (!caseNumber.value) {
                document.getElementById('case-error').innerHTML = 'Case number is required.';
                valid = false;
            }

            // Check Payment Description
            const paymentDescription = document.querySelector('[name="paymentDesc"]');
            if (!paymentDescription.value) {
                document.getElementById('payment-description-error').innerHTML = 'Payment description is required.';
                valid = false;
            }

            // Check Payment Amount
            const paymentAmount = document.querySelector('[name="amount"]');
            if (!paymentAmount.value) {
                document.getElementById('payment-amount-error').innerHTML = 'Payment amount is required.';
                valid = false;
            }

            // Check Payment Due Date
            const paymentDue = document.querySelector('[name="dueDate"]');
            if (!paymentDue.value) {
                document.getElementById('payment-due-error').innerHTML = 'Payment due date is required.';
                valid = false;
            }

            // Prevent form submission if invalid
            if (!valid) {
                event.preventDefault();
            }
        });


        const caseData = <?= json_encode($case) ?>;

        const clientSelect = document.querySelector('[name="clientID"]');
        const caseSelect = document.getElementById('caseID');

        // Function to populate case dropdown
        function updateCaseOptions(clientId) {
            caseSelect.innerHTML = '<option value="">-- Select a case --</option>'; // Clear old options
            caseData.forEach(c => {
                if (c.client_id == clientId) {
                    const option = document.createElement('option');
                    option.value = c.id;
                    option.textContent = c.case_number;
                    caseSelect.appendChild(option);
                }
            });
        }

        // On page load - optional
        updateCaseOptions(clientSelect.value);

        // On client selection change
        clientSelect.addEventListener('change', function () {
            updateCaseOptions(this.value);
        });




    </script>


</html>
</div>