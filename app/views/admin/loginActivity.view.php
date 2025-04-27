<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Admin Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/loginactivity.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Filter controls styling */
        .filter-controls {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-end;
        }
        
        .filter-group {
            flex: 1;
            min-width: 200px;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #555;
        }
        
        .filter-group input, 
        .filter-group select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        
        .filter-buttons {
            display: flex;
            gap: 10px;
        }
        
        .filter-buttons button {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-apply {
            background: #4154f1;
            color: white;
        }
        
        .btn-apply:hover {
            background: #3040d0;
        }
        
        .btn-reset {
            background: #f5f5f5;
            color: #333;
        }
        
        .btn-reset:hover {
            background: #e5e5e5;
        }
        
        /* Sortable headers */
        th.sortable {
            cursor: pointer;
            position: relative;
            padding-right: 25px;
        }
        
        th.sortable:after {
            content: "\f0dc";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            position: absolute;
            right: 8px;
            color: rgba(255, 255, 255, 0.5);
        }
        
        th.sortable.asc:after {
            content: "\f0de";
            color: white;
        }
        
        th.sortable.desc:after {
            content: "\f0dd";
            color: white;
        }
        
        /* No results message */
        .no-results {
            text-align: center;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 5px;
            color: #666;
            font-style: italic;
            margin: 20px 0;
            display: none;
        }
    </style>
</head>

<body>
    <?php include('component/navBar.view.php'); ?>
    <?php include('component/sideBar.view.php'); ?>
    
    <div class="home-section">
        <div class="login-container">
            <h2>Login Activity Of All Users</h2>
            
            <!-- Filter and Search Controls -->
            <div class="filter-controls">
                <div class="filter-group">
                    <label for="search">Search</label>
                    <input type="text" id="search" placeholder="Username, IP, User ID...">
                </div>
                
                <div class="filter-group">
                    <label for="status">Status</label>
                    <select id="status">
                        <option value="">All</option>
                        <option value="success">Success</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="role">Role</label>
                    <select id="role">
                        <option value="">All</option>
                        <option value="admin">Admin</option>
                        <option value="client">Client</option>
                        <option value="precedent">Precedent</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="date_from">Date From</label>
                    <input type="date" id="date_from">
                </div>
                
                <div class="filter-group">
                    <label for="date_to">Date To</label>
                    <input type="date" id="date_to">
                </div>
                
                <div class="filter-buttons">
                    <button type="button" class="btn-apply" id="btn-apply">Apply Filters</button>
                    <button type="button" class="btn-reset" id="btn-reset">Reset</button>
                </div>
            </div>
            
            <div class="no-results">No matching login activity found</div>
            
            <table id="loginTable">
                <thead>
                    <tr>
                        <th class="sortable" data-sort="date">Logged In At</th>
                        <th class="sortable" data-sort="username">User Name</th>
                        <th class="sortable" data-sort="status">Status</th>
                        <th class="sortable" data-sort="userid">User ID</th>
                        <th class="sortable" data-sort="ip">IP Address</th>
                        <th class="sortable" data-sort="role">Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($login)): ?>
                        <?php foreach($login as $log): ?>
                            <tr>
                                <td><?= date('M d, Y h:i:s A', strtotime($log->login_time)) ?></td>
                                <td><?= $log->username ?? 'Unknown' ?></td>
                                <td class="status <?= strtolower($log->status) === 'success' ? 'success' : 'failed' ?>"><?= strtoupper($log->status) ?></td>
                                <td><?= $log->user_id ?? 'N/A' ?></td>
                                <td><?= $log->ip_address ?? 'Unknown' ?></td>
                                <td><?= $log->role ?? 'Unknown' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr class="no-data-row">
                            <td colspan="6" style="text-align: center;">No login activity found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('loginTable');
            const tbody = table.querySelector('tbody');
            const noResults = document.querySelector('.no-results');
            const searchInput = document.getElementById('search');
            const statusFilter = document.getElementById('status');
            const roleFilter = document.getElementById('role');
            const dateFromFilter = document.getElementById('date_from');
            const dateToFilter = document.getElementById('date_to');
            const applyBtn = document.getElementById('btn-apply');
            const resetBtn = document.getElementById('btn-reset');
            
            // Store original table data
            const originalRows = Array.from(tbody.querySelectorAll('tr:not(.no-data-row)'));
            let currentSort = { column: 'date', direction: 'desc' };
            
            // Check if table has data
            const hasData = originalRows.length > 0;
            
            // Apply filters function
            function applyFilters() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value.toLowerCase();
                const roleValue = roleFilter.value.toLowerCase();
                const dateFrom = dateFromFilter.value ? new Date(dateFromFilter.value) : null;
                const dateTo = dateToFilter.value ? new Date(dateToFilter.value + 'T23:59:59') : null;
                
                // Clear current table
                while (tbody.firstChild) {
                    tbody.removeChild(tbody.firstChild);
                }
                
                if (!hasData) {
                    const noDataRow = document.createElement('tr');
                    noDataRow.className = 'no-data-row';
                    noDataRow.innerHTML = '<td colspan="6" style="text-align: center;">No login activity found</td>';
                    tbody.appendChild(noDataRow);
                    noResults.style.display = 'none';
                    return;
                }
                
                // Filter rows
                let filteredRows = originalRows.filter(row => {
                    const cells = Array.from(row.cells);
                    const rowText = cells.map(cell => cell.textContent.toLowerCase()).join(' ');
                    
                    // Search filter
                    if (searchTerm && !rowText.includes(searchTerm)) {
                        return false;
                    }
                    
                    // Status filter
                    if (statusValue && !cells[2].textContent.toLowerCase().includes(statusValue)) {
                        return false;
                    }
                    
                    // Role filter
                    if (roleValue && !cells[5].textContent.toLowerCase().includes(roleValue)) {
                        return false;
                    }
                    
                    // Date range filter
                    if (dateFrom || dateTo) {
                        const rowDate = new Date(cells[0].textContent);
                        
                        if (dateFrom && rowDate < dateFrom) {
                            return false;
                        }
                        
                        if (dateTo && rowDate > dateTo) {
                            return false;
                        }
                    }
                    
                    return true;
                });
                
                // Apply current sort to filtered rows
                sortRows(filteredRows, currentSort.column, currentSort.direction === 'asc');
                
                // Show no results message if needed
                if (filteredRows.length === 0) {
                    noResults.style.display = 'block';
                } else {
                    noResults.style.display = 'none';
                    
                    // Add filtered rows to table
                    filteredRows.forEach(row => {
                        tbody.appendChild(row.cloneNode(true));
                    });
                }
            }
            
            // Sorting function
            function sortRows(rows, column, ascending) {
                const columnIndex = {
                    'date': 0,
                    'username': 1,
                    'status': 2,
                    'userid': 3,
                    'ip': 4,
                    'role': 5
                }[column];
                
                rows.sort((a, b) => {
                    let valueA = a.cells[columnIndex].textContent;
                    let valueB = b.cells[columnIndex].textContent;
                    
                    // Special handling for dates
                    if (column === 'date') {
                        return ascending ? 
                            new Date(valueA) - new Date(valueB) : 
                            new Date(valueB) - new Date(valueA);
                    }
                    
                    // Special handling for user IDs (numeric)
                    if (column === 'userid') {
                        valueA = valueA === 'N/A' ? -1 : parseInt(valueA);
                        valueB = valueB === 'N/A' ? -1 : parseInt(valueB);
                        return ascending ? valueA - valueB : valueB - valueA;
                    }
                    
                    // Default string comparison
                    return ascending ? 
                        valueA.localeCompare(valueB) : 
                        valueB.localeCompare(valueA);
                });
            }
            
            // Set up sortable column headers
            document.querySelectorAll('th.sortable').forEach(th => {
                th.addEventListener('click', function() {
                    const column = this.getAttribute('data-sort');
                    
                    // Toggle sort direction or set to asc if different column
                    if (currentSort.column === column) {
                        currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
                    } else {
                        currentSort = { column, direction: 'asc' };
                    }
                    
                    // Update header classes
                    document.querySelectorAll('th.sortable').forEach(header => {
                        header.classList.remove('asc', 'desc');
                    });
                    
                    this.classList.add(currentSort.direction);
                    
                    // Apply filters and sort
                    applyFilters();
                });
            });
            
            // Event listeners
            applyBtn.addEventListener('click', applyFilters);
            
            resetBtn.addEventListener('click', function() {
                // Clear all filter inputs
                searchInput.value = '';
                statusFilter.value = '';
                roleFilter.value = '';
                dateFromFilter.value = '';
                dateToFilter.value = '';
                
                // Reset sort to default (date desc)
                currentSort = { column: 'date', direction: 'desc' };
                
                // Update header classes
                document.querySelectorAll('th.sortable').forEach(header => {
                    header.classList.remove('asc', 'desc');
                    if (header.getAttribute('data-sort') === 'date') {
                        header.classList.add('desc');
                    }
                });
                
                // Reset table
                applyFilters();
            });
            
            // Initialize sorting indicators
            document.querySelector(`th[data-sort="${currentSort.column}"]`).classList.add(currentSort.direction);
        });
    </script>
</body>
</html>