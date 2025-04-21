<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Payment</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/client/payments.css">
    <script src="https://js.stripe.com/v3/"></script> <!-- Stripe.js -->
</head>

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include(__DIR__ . '/../seniorCounsel/component/sidebar.view.php'); ?>



    <div class="home-section">
        <div class="invoice-container">
            <div class="documents-card">
                <p>Click here to view payment invoices</p>
                <a href="<?= ROOT ?>/clientinvoice"><button>Invoices</button></a>
            </div>
        </div>
        <div class="payment-header">
            <h1>Make a Secure Payment</h1>
        </div>
        <div class="payment-paragraph">
            <p>To proceed with the payment, please fill in the following details. Your payment will be processed securely.</p>
            <p>Card details will not be shared with any third party.</p>
        </div>
        <div class="pay_container">
            <div id="Checkout" class="inline">
                <h1>Pay Invoice</h1>
                <div class="card-row">
                    <span class="visa"></span>
                    <span class="mastercard"></span>
                    <span class="amex"></span>
                    <span class="discover"></span>
                </div>

                <form id="paymentForm">
                    <div class="form-group">
                        <label for="CaseNumber">Case Number</label>
                        <select id="CaseNumber" class="form-control" required>
                            <option value="">-- Select a Case --</option>
                            <?php if (!empty($data['cases'])): ?>
                                <?php foreach ($data['cases'] as $case): ?>
                                    <option value="<?= htmlspecialchars($case->case_number) ?>">
                                        <?= htmlspecialchars($case->case_number) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="">No cases found</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="IDNumber">ID Number</label>
                        <input id="IDNumber" class="form-control" type="text" placeholder="Enter ID Number" required />
                    </div>

                    <div class="form-group">
                        <label for="PaymentAmount">Payment Amount</label>
                        <div class="amount-placeholder">
                            <span>LKR</span>
                            <input id="PaymentAmount" class="form-control amount-input" type="number" min="1000" step="500" placeholder="Enter amount" required />
                        </div>
                    </div>

                    <div class="btn_pay">
                        <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">
                            <span class="align-middle">Proceed to Payment</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stripe = Stripe("<?= STRIPE_PUBLIC ?>"); // Load Stripe public key
            const payButton = document.getElementById("PayButton");
            const paymentForm = document.getElementById("paymentForm");

            paymentForm.addEventListener("submit", function(event) {
                event.preventDefault();

                const caseNumber = document.getElementById("CaseNumber").value.trim();
                const idNumber = document.getElementById("IDNumber").value.trim();
                const amount = document.getElementById("PaymentAmount").value.trim();

                if (!caseNumber || !idNumber || !amount) {
                    alert("Please fill all required fields.");
                    return;
                }

                fetch("<?= ROOT ?>/PaymentController/createCheckoutSession", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            case_number: caseNumber,
                            id_number: idNumber,
                            amount: amount
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.id) {
                            stripe.redirectToCheckout({
                                sessionId: data.id
                            });
                        } else {
                            alert("Payment processing failed.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    </script>
</body>

</html>