// Function to filter table rows based on selected date range
function filterByDateRange() {
    // Get the selected "From" and "To" dates from input fields
    const fromDate = document.getElementById("date-from").value;
    const toDate = document.getElementById("date-to").value;
    
    // If no dates are selected, do nothing
    if (!fromDate && !toDate) return;
    
    // Get all rows inside the table body
    const rows = document.querySelectorAll(".task-table tbody tr");
    let visibleCount = 0; // Counter to track how many rows are visible after filtering
    
    rows.forEach(row => {
        // Get the deadline date text from the third column (index 2)
        const deadlineStr = row.cells[2].textContent;
        const deadline = new Date(deadlineStr); // Convert the deadline string into a Date object
        
        let show = true; // Flag to determine if this row should be shown
        
        // If "from date" is selected and the deadline is before it, hide the row
        if (fromDate && new Date(fromDate) > deadline) show = false;
        
        // If "to date" is selected and the deadline is after it, hide the row
        if (toDate && new Date(toDate) < deadline) show = false;
        
        // Show or hide the row based on the 'show' flag
        row.style.display = show ? "" : "none";
        
        // If the row is visible, increment the visible row counter
        if (show) visibleCount++;
    });
    
    // If no rows are visible after filtering, show the "No results" message
    document.getElementById("no-results").style.display = visibleCount === 0 ? "block" : "none";
}

// Function to clear the date filter and show all table rows
function clearDateFilter() {
    // Clear the input fields
    document.getElementById("date-from").value = "";
    document.getElementById("date-to").value = "";
    
    // Get all rows inside the table body
    const rows = document.querySelectorAll(".task-table tbody tr");
    
    // Show all rows
    rows.forEach(row => {
        row.style.display = "";
    });
    
    // Hide the "No results" message
    document.getElementById("no-results").style.display = "none";
}
