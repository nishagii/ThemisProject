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

            <p> Here are the invoices sent for the
                <span style="color: #fa9800; font-weight: bold;">Clients. </span> Click on the invoice to view the details.
            </p>
            <div class="invoice-container">

                <!-- Sort Button Section -->
                <div class="sort-section">
                    <label for="sort-invoices">Sort by:</label>
                    <select id="sort-invoices" onchange="sortInvoices()">
                        <option value="date-desc">Due Date (Newest)</option>
                        <option value="date-asc">Due Date (Oldest)</option>
                        <option value="amount-asc">Amount (Low to High)</option>
                        <option value="amount-desc">Amount (High to Low)</option>
                    </select>
                </div>


                <div class="payment-section">
                    <button class="payment-button" onclick="window.location.href='<?= ROOT ?>/paymentGate/paidReceipts'">
                        <i class='bx bx-file'></i>
                        <p>View Paid Receipts</p>
                    </button>
                </div>

                <div class="invoice-header">


                    <div>Due Date</div>
                    <div>Client</div>
                    <div>Amount</div>
                    <div>Invoice</div>
                    <div>Send to Client</div>
                   
                </div>

                <?php if (!empty($invoices)): ?>
                    <?php foreach ($invoices as $invoice): ?>
                        <div class="invoice-row">

                            <div class="due-date"><?= htmlspecialchars($invoice->dueDate) ?></div>
                            <div class="client"><?= htmlspecialchars($invoice->clientName) ?></div>
                            <div class="amount">Rs. <?= htmlspecialchars($invoice->amount) ?></div>
                            <div>
                                <a href="<?= ROOT ?>/invoice/viewInvoice/<?= $invoice->invoiceID ?>" class="view-button">View</a>

                            </div>
                            <div>
                                <?php if ($invoice->sent): ?>
                                    <span class="invoice-sent-label">Sent</span>
                                <?php else: ?>
                                    <a href="<?= ROOT ?>/invoice/markInvoiceAsSent/<?= $invoice->invoiceID ?>" class="send-button">Send</a>
                                <?php endif; ?>
                            </div>

                            
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align:center; margin-top: 20px;">No invoices found.</p>
                <?php endif; ?>


            </div>
        </div>

    </div>
    <script>
        function sortInvoices() {
            const option = document.getElementById("sort-invoices").value;
            const rows = Array.from(document.querySelectorAll(".invoice-row"));
            const container = document.querySelector(".invoice-container");

            rows.sort((a, b) => {
                const dateA = new Date(a.querySelector(".due-date").textContent.trim());
                const dateB = new Date(b.querySelector(".due-date").textContent.trim());
                const clientA = a.querySelector(".client").textContent.trim().toLowerCase();
                const clientB = b.querySelector(".client").textContent.trim().toLowerCase();
                const amountA = parseFloat(a.querySelector(".amount").textContent.replace(/[^\d.]/g, ""));
                const amountB = parseFloat(b.querySelector(".amount").textContent.replace(/[^\d.]/g, ""));

                switch (option) {
                    case "date-asc":
                        return dateA - dateB;
                    case "date-desc":
                        return dateB - dateA;
                    case "client-asc":
                        return clientA.localeCompare(clientB);
                    case "client-desc":
                        return clientB.localeCompare(clientA);
                    case "amount-asc":
                        return amountA - amountB;
                    case "amount-desc":
                        return amountB - amountA;
                }
            });

            rows.forEach(row => container.appendChild(row));
        }
    </script>

</body>

</html>
</div>