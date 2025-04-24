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
    <!-- DataTables Responsive Extension -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <style>
        /* Search box styling */
        .search-container {
            margin: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-box {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 4px;
            padding: 8px 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .search-box input {
            border: none;
            outline: none;
            width: 100%;
            padding: 5px;
            font-size: 14px;
        }

        .search-box i {
            color: #777;
            margin-right: 10px;
        }

        .filter-options {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-label {
            font-weight: bold;
            color: #1d1b31;
            white-space: nowrap;
        }

        .filter-select {
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: white;
        }

        .amount-input {
            width: 100px;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .filter-btn {
            padding: 8px 15px;
            border-radius: 4px;
            border: none;
            background-color: #1d1b31;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            background-color: #fa9800;
        }

        /* Status badge styling enhancement */
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
            min-width: 80px;
        }

        .status-paid {
            background-color: #d4edda;
            color: #155724;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .search-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-box {
                width: 100%;
            }

            .filter-options {
                width: 100%;
                justify-content: space-between;
            }
        }

        /* Search highlighting styles */
        .highlight {
            background-color: #fff3cd;
            color: #856404;
            padding: 2px 4px;
            border-radius: 3px;
            font-weight: bold;
        }
    </style>
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

        <!-- Search and filter container -->
        <div class="search-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search by case number, client name, etc...">
            </div>

            <div class="filter-options">
                <div class="filter-group">
                    <span class="filter-label">Sort by:</span>
                    <select id="dateSort" class="filter-select">
                        <option value="latest">Latest First</option>
                        <option value="oldest">Oldest First</option>
                    </select>
                </div>

                <div class="filter-group">
                    <span class="filter-label">Amount:</span>
                    <input type="number" id="minAmount" placeholder="Min" class="amount-input" step="500" min="0">
                    <span>to</span>
                    <input type="number" id="maxAmount" placeholder="Max" class="amount-input" step="500" min="500">
                </div>


                <button id="resetFilters" class="filter-btn">Reset Filters</button>
            </div>
        </div>

        <div class="table-container">
            <table class="table table-bordered display responsive nowrap" id="paymentsTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Case Number</th>
                        <th>Client Name</th>
                        <th>ID Number</th>
                        <th>Client Number</th>
                        <th>Court</th>
                        <th>Amount</th>
                        <th>Payment Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($payments)): ?>
                        <?php foreach ($payments as $payment): ?>
                            <tr data-amount="<?= $payment->amount ?>">
                                <td data-title="Case Number"><?= $payment->case_number ?></td>
                                <td data-title="Client Name"><?= $payment->client_name ?? 'N/A' ?></td>
                                <td data-title="ID Number"><?= $payment->id_number ?></td>
                                <td data-title="Client Number"><?= $payment->client_number ?? 'N/A' ?></td>
                                <td data-title="Court"><?= $payment->court ?? 'N/A' ?></td>
                                <td data-title="Amount"><?= number_format($payment->amount, 2) ?></td>
                                <td data-title="Status">
                                    <span class="status-badge status-paid">
                                        <?= $payment->payment_status ?>
                                    </span>
                                </td>
                                <td data-title="Date"><?= date('M d, Y', strtotime($payment->created_at)) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center;">No payment records found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#paymentsTable').DataTable({
                responsive: true,
                "order": [
                    [7, "desc"]
                ], // Sort by date (column 7) in descending order by default
                "columnDefs": [{
                        "responsivePriority": 1,
                        "targets": [0, 5, 6]
                    }, // Prioritize these columns
                    {
                        "responsivePriority": 2,
                        "targets": [1, 7]
                    },
                    {
                        "responsivePriority": 3,
                        "targets": [2, 3, 4]
                    }
                ],
                // Hide the default search box
                "dom": 'lrtip'
            });

            // Custom search functionality with highlighting
            $('#searchInput').on('keyup', function() {
                var searchTerm = this.value;

                // Apply the search
                table.search(searchTerm).draw();

                // Remove any existing highlights
                $('#paymentsTable tbody td').each(function() {
                    var text = $(this).text();
                    $(this).html(text);
                });

                // If search term is not empty, highlight matches
                if (searchTerm.trim() !== '') {
                    highlightSearchTerm(searchTerm);
                }
            });

            // Function to highlight search term in table cells
            function highlightSearchTerm(term) {
                // Create a case-insensitive regular expression for the search term
                var regex = new RegExp('(' + term.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&') + ')', 'gi');

                // Apply highlighting to each cell
                $('#paymentsTable tbody td').each(function() {
                    var cell = $(this);

                    // Skip cells with status badges or other complex content
                    if (cell.find('.status-badge').length > 0) {
                        return;
                    }

                    var content = cell.text();

                    // Only highlight if the cell contains the search term
                    if (content.toLowerCase().indexOf(term.toLowerCase()) >= 0) {
                        cell.html(content.replace(regex, '<span class="highlight">$1</span>'));
                    }
                });
            }

            // Date sorting
            $('#dateSort').on('change', function() {
                var sortOrder = $(this).val() === 'oldest' ? 'asc' : 'desc';
                table.order([7, sortOrder]).draw();

                // Re-apply highlighting after sorting
                var searchTerm = $('#searchInput').val();
                if (searchTerm.trim() !== '') {
                    highlightSearchTerm(searchTerm);
                }
            });

            // Amount range filtering
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var min = parseFloat($('#minAmount').val()) || 0;
                    var max = parseFloat($('#maxAmount').val()) || Infinity;

                    // Get the amount from the row (column 5)
                    var amount = parseFloat(data[5].replace(/[^0-9.-]+/g, '')) || 0;

                    if ((min <= amount && amount <= max)) {
                        return true;
                    }
                    return false;
                }
            );

            // Apply amount filters when inputs change
            $('#minAmount, #maxAmount').on('input', function() {
                table.draw();

                // Re-apply highlighting after filtering
                var searchTerm = $('#searchInput').val();
                if (searchTerm.trim() !== '') {
                    highlightSearchTerm(searchTerm);
                }
            });

            // Reset filters button
            $('#resetFilters').on('click', function() {
                $('#searchInput').val('');
                $('#dateSort').val('latest');
                $('#minAmount').val('');
                $('#maxAmount').val('');

                // Reset search and sorting
                table.search('').order([7, 'desc']).draw();

                // Remove any existing highlights
                $('#paymentsTable tbody td').each(function() {
                    var text = $(this).text();
                    $(this).html(text);
                });
            });
        });
    </script>
</body>

</html>