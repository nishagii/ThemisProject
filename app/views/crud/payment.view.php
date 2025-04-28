<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/payments.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        /* Advanced search and filter styles */
        .search-filter-container {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .search-row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            align-items: center;
        }
        
        .search-input {
            flex: 1;
            position: relative;
        }
        
        .search-input input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .search-input i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }
        
        .filter-row {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .filter-group {
            flex: 1;
            min-width: 200px;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }
        
        .filter-group select, 
        .filter-group input[type="date"] {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
            font-size: 14px;
        }
        
        .filter-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 15px;
        }
        
        .filter-actions button {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .apply-filters {
            background-color: #fa9800;
            color: white;
        }
        
        .apply-filters:hover {
            background-color: #e08700;
        }
        
        .reset-filters {
            background-color: #f0f0f0;
            color: #333;
        }
        
        .reset-filters:hover {
            background-color: #e0e0e0;
        }
        
        /* Badge styles for payment status */
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
            display: inline-block;
            min-width: 80px;
        }
        
        .status-sent {
            background-color: #e6f7ff;
            color: #1890ff;
        }
        
        .status-pending {
            background-color: #fff7e6;
            color: #fa8c16;
        }
        
        .status-paid {
            background-color: #f6ffed;
            color: #52c41a;
        }
        
        .status-overdue {
            background-color: #fff1f0;
            color: #f5222d;
        }
        
        /* No results message */
        .no-results {
            text-align: center;
            padding: 30px;
            color: #888;
            font-style: italic;
            display: none;
            background-color: #f9f9f9;
            border-radius: 8px;
            margin-top: 20px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .search-row, .filter-row {
                flex-direction: column;
                gap: 10px;
            }
            
            .filter-group {
                width: 100%;
            }
        }
    </style>
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
            
            <!-- Advanced Search and Filter Section -->
            <div class="search-filter-container">
                <div class="search-row">
                    <div class="search-input">
                        <i class='bx bx-search'></i>
                        <input type="text" id="invoice-search" placeholder="Search by client name, amount, invoice number...">
                    </div>
                </div>
                
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="status-filter">Payment Status</label>
                        <select id="status-filter">
                            <option value="all">All Statuses</option>
                            <option value="sent">Sent</option>
                            <option value="pending">Pending</option>
                            <option value="paid">Paid</option>
                            <option value="overdue">Overdue</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="date-from">Due Date From</label>
                        <input type="date" id="date-from">
                    </div>
                    
                    <div class="filter-group">
                        <label for="date-to">Due Date To</label>
                        <input type="date" id="date-to">
                    </div>
                    
                    <div class="filter-group">
                        <label for="amount-filter">Amount Range</label>
                        <select id="amount-filter">
                            <option value="all">All Amounts</option>
                            <option value="0-1000">Rs. 0 - Rs. 1,000</option>
                            <option value="1000-5000">Rs. 1,000 - Rs. 5,000</option>
                            <option value="5000-10000">Rs. 5,000 - Rs. 10,000</option>
                            <option value="10000-50000">Rs. 10,000 - Rs. 50,000</option>
                            <option value="50000+">Rs. 50,000+</option>
                        </select>
                    </div>
                </div>
                
                <div class="filter-actions">
                    <button class="reset-filters" onclick="resetFilters()">Reset Filters</button>
                    <button class="apply-filters" onclick="applyFilters()">Apply Filters</button>
                </div>
            </div>
            
            <div class="invoice-container">
                <!-- Sort Button Section -->
                <div class="sort-section">
                    <label for="sort-invoices">Sort by:</label>
                    <select id="sort-invoices" onchange="sortInvoices()">
                        <option value="date-desc">Due Date (Newest)</option>
                        <option value="date-asc">Due Date (Oldest)</option>
                        <option value="amount-asc">Amount (Low to High)</option>
                        <option value="amount-desc">Amount (High to Low)</option>
                        <option value="client-asc">Client Name (A-Z)</option>
                        <option value="client-desc">Client Name (Z-A)</option>
                        <option value="status-asc">Status (A-Z)</option>
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
                    <div>Payment Status</div>
                </div>

                <?php if (!empty($invoices)): ?>
                    <?php foreach ($invoices as $invoice): ?>
                        <div class="invoice-row" 
                             data-client="<?= htmlspecialchars($invoice->clientName) ?>" 
                             data-amount="<?= htmlspecialchars($invoice->amount) ?>" 
                             data-date="<?= htmlspecialchars($invoice->dueDate) ?>" 
                             data-status="<?= $invoice->sent ? 'sent' : 'pending' ?>">
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
                            <div class="status">
                                <?php 
                                    $statusClass = '';
                                    $statusText = $invoice->sent ? 'Sent' : 'Pending';
                                    
                                    // Determine if invoice is overdue
                                    $dueDate = new DateTime($invoice->dueDate);
                                    $today = new DateTime();
                                    
                                    if ($invoice->sent && $dueDate < $today) {
                                        $statusClass = 'status-overdue';
                                        $statusText = 'Overdue';
                                    } elseif ($invoice->sent) {
                                        $statusClass = 'status-sent';
                                    } else {
                                        $statusClass = 'status-pending';
                                    }
                                ?>
                                <span class="status-badge <?= $statusClass ?>"><?= $statusText ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align:center; margin-top: 20px;">No invoices found.</p>
                <?php endif; ?>
            </div>
            
            <!-- No results message -->
            <div id="no-results" class="no-results">
                No invoices found matching your search criteria.
            </div>
        </div>
    </div>
    
    <script>
        // Sort invoices based on selected option
        function sortInvoices() {
            const option = document.getElementById("sort-invoices").value;
            const rows = Array.from(document.querySelectorAll(".invoice-row"));
            const container = document.querySelector(".invoice-container");
            
            // Get all visible rows (not filtered out)
            const visibleRows = rows.filter(row => row.style.display !== 'none');
            
            visibleRows.sort((a, b) => {
                const dateA = new Date(a.querySelector(".due-date").textContent.trim());
                const dateB = new Date(b.querySelector(".due-date").textContent.trim());
                const clientA = a.querySelector(".client").textContent.trim().toLowerCase();
                const clientB = b.querySelector(".client").textContent.trim().toLowerCase();
                const amountA = parseFloat(a.querySelector(".amount").textContent.replace(/[^\d.]/g, ""));
                const amountB = parseFloat(b.querySelector(".amount").textContent.replace(/[^\d.]/g, ""));
                const statusA = a.querySelector(".status").textContent.trim().toLowerCase();
                const statusB = b.querySelector(".status").textContent.trim().toLowerCase();

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
                    case "status-asc":
                        return statusA.localeCompare(statusB);
                }
            });
            
            // Reorder the visible rows
            const header = document.querySelector(".invoice-header");
            container.innerHTML = '';
            container.appendChild(header);
            
            visibleRows.forEach(row => container.appendChild(row));
            
            // Re-add the payment section
            const paymentSection = document.querySelector(".payment-section");
            if (paymentSection) {
                container.insertBefore(paymentSection, header);
            }
            
            // Re-add the sort section
            const sortSection = document.querySelector(".sort-section");
            if (sortSection) {
                container.insertBefore(sortSection, paymentSection || header);
            }
        }
        
        // Search functionality
        document.getElementById("invoice-search").addEventListener("input", function() {
            const searchTerm = this.value.toLowerCase();
            filterInvoices();
        });
        
        // Apply all filters
        function applyFilters() {
            filterInvoices();
        }
        
        // Reset all filters
        function resetFilters() {
            // Clear search input
            document.getElementById("invoice-search").value = "";
            
            // Reset all dropdowns to default
            document.getElementById("status-filter").value = "all";
            document.getElementById("amount-filter").value = "all";
            
            // Clear date inputs
            document.getElementById("date-from").value = "";
            document.getElementById("date-to").value = "";
            
            // Show all invoice rows
            const rows = document.querySelectorAll(".invoice-row");
            rows.forEach(row => {
                row.style.display = "";
            });
            
            // Hide no results message
            document.getElementById("no-results").style.display = "none";
        }

        // Filter invoices based on search and filter criteria
        function filterInvoices() {
            const searchTerm = document.getElementById("invoice-search").value.toLowerCase();
            const statusFilter = document.getElementById("status-filter").value;
            const dateFrom = document.getElementById("date-from").value;
            const dateTo = document.getElementById("date-to").value;
            const amountFilter = document.getElementById("amount-filter").value;
            
            const rows = document.querySelectorAll(".invoice-row");
            let visibleCount = 0;
            
            rows.forEach(row => {
                const client = row.getAttribute("data-client").toLowerCase();
                const amount = parseFloat(row.getAttribute("data-amount"));
                const date = new Date(row.getAttribute("data-date"));
                const status = row.getAttribute("data-status");
                
                // Get text content for searching
                const rowText = row.textContent.toLowerCase();
                
                // Check search term
                const matchesSearch = searchTerm === "" || rowText.includes(searchTerm);
                
                // Check status filter
                const matchesStatus = statusFilter === "all" || status === statusFilter;
                
                // Check date range
                let matchesDateRange = true;
                if (dateFrom && new Date(dateFrom) > date) {
                    matchesDateRange = false;
                }
                if (dateTo && new Date(dateTo) < date) {
                    matchesDateRange = false;
                }
                
                // Check amount range
                let matchesAmount = true;
                if (amountFilter !== "all") {
                    const [min, max] = amountFilter.split("-").map(val => val === "+" ? Infinity : parseFloat(val));
                    matchesAmount = amount >= min && (max === Infinity || amount <= max);
                }
                
                // Show/hide row based on all filters
                if (matchesSearch && matchesStatus && matchesDateRange && matchesAmount) {
                    row.style.display = "";
                    visibleCount++;
                } else {
                    row.style.display = "none";
                }
            });
            
            // Show/hide no results message
            document.getElementById("no-results").style.display = visibleCount === 0 ? "block" : "none";
            
            // Re-sort visible rows
            sortInvoices();
        }
    </script>
</body>
</html>