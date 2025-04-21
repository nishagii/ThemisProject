document.addEventListener('DOMContentLoaded', function() {
    // Filter button toggle
    const filterBtn = document.getElementById('filter-btn');
    const filterMenu = document.getElementById('filter-menu');
    
    filterBtn.addEventListener('click', function() {
        filterMenu.classList.toggle('active');
    });
    
    // Close filter menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!filterBtn.contains(event.target) && !filterMenu.contains(event.target)) {
            filterMenu.classList.remove('active');
        }
    });
    
    // Search functionality
    const searchInput = document.getElementById('search-input');
    const userRows = document.querySelectorAll('#user-table-body tr');
    const noResults = document.getElementById('no-results');
    
    function applyFilters() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedRoles = Array.from(document.querySelectorAll('input[data-filter="role"]:checked')).map(el => el.value);
        const selectedStatuses = Array.from(document.querySelectorAll('input[data-filter="status"]:checked')).map(el => el.value);
        
        let visibleCount = 0;
        
        userRows.forEach(row => {
            const name = row.getAttribute('data-name');
            const email = row.getAttribute('data-email');
            const role = row.getAttribute('data-role');
            const status = row.getAttribute('data-status');
            
            // Search term matching
            const matchesSearch = searchTerm === '' || 
                                name.includes(searchTerm) || 
                                email.includes(searchTerm) || 
                                role.includes(searchTerm);
            
            // Role filtering
            const matchesRole = selectedRoles.length === 0 || selectedRoles.includes(role);
            
            // Status filtering
            const matchesStatus = selectedStatuses.length === 0 || selectedStatuses.includes(status);
            
            // Show/hide row based on all criteria
            if (matchesSearch && matchesRole && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Show "no results" message if needed
        if (visibleCount === 0 && userRows.length > 0) {
            noResults.style.display = 'flex';
        } else {
            noResults.style.display = 'none';
        }
    }
    
    // Apply search as user types
    if (searchInput) {
        searchInput.addEventListener('input', applyFilters);
    }
    
    // Apply button for filters
    document.getElementById('apply-filters').addEventListener('click', function() {
        applyFilters();
        filterMenu.classList.remove('active');
    });
    
    // Reset filters
    document.getElementById('reset-filters').addEventListener('click', function() {
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.checked = false;
        });
        searchInput.value = '';
        applyFilters();
    });
    
    // Sorting functionality
    const sortSelect = document.getElementById('sort-users');
    const tableBody = document.getElementById('user-table-body');

    if (sortSelect && tableBody) {
        sortSelect.addEventListener('change', function() {
            const sortBy = this.value;
            if (!sortBy) return;

            const rows = Array.from(tableBody.querySelectorAll('tr'));

            // Sort rows based on data attributes directly
            rows.sort((a, b) => {
                const aValue = a.getAttribute('data-' + sortBy).toLowerCase();
                const bValue = b.getAttribute('data-' + sortBy).toLowerCase();
                return aValue.localeCompare(bValue);
            });

            // Re-append sorted rows
            rows.forEach(row => tableBody.appendChild(row));
        });
    }
});