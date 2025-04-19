<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paid Receipts</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/paidReciepts.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>

    <div class="home-section">
        <div class="allcases-section">
            <h1>Paid Receipts</h1>
        </div>
        <div class="paragraph-all-cases">
            View all <span style="color: #fa9800; font-weight: bold;">payment records</span> and manage
            <span style="color: #fa9800; font-weight: bold;">receipts</span>.
        </div>

        <div class="button">
            <a href="<?= ROOT ?>/paymentGate">
                <button class="add">Back to Payments</button>
            </a>
        </div>

        <div class="table-container">
            <table class="table table-bordered" id="paymentsTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Case Number</th>
                        <th>ID Number</th>
                        <th>Amount</th>
                        <th>Payment Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($payments)): ?>
                        <?php foreach ($payments as $payment): ?>
                            <tr>
                                <td><?= $payment->case_number ?></td>
                                <td><?= $payment->id_number ?></td>
                                <td><?= number_format($payment->amount, 2) ?></td>
                                <td>
                                    <span class="status-badge <?= $payment->payment_status == 'Paid' ? 'status-paid' : 'status-pending' ?>">
                                        <?= $payment->payment_status ?>
                                    </span>
                                </td>
                                <td><?= date('M d, Y', strtotime($payment->created_at)) ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="<?= ROOT ?>/paymentGate/viewReceipt/<?= $payment->id ?>">
                                            <button class="view-button">
                                                <i class="bx bx-show"></i> View
                                            </button>
                                        </a>
                                        <a href="<?= ROOT ?>/paymentGate/printReceipt/<?= $payment->id ?>">
                                            <button class="print-button">
                                                <i class="bx bx-printer"></i> Print
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">No payment records found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#paymentsTable').DataTable({
                "order": [
                    [4, "desc"]
                ] // Sort by date (column 4) in descending order
            });
        });

        function confirmDelete(paymentId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this payment record? This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#93a8e3',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                background: '#fafafa',
                color: '#1d1b31',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the delete action
                    window.location.href = `<?= ROOT ?>/paymentGate/deletePayment/${paymentId}`;
                }
            });
        }
    </script>
</body>

</html>