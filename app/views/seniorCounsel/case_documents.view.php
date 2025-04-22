<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/one_case.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/document.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    
    <div class="home-section">
        <h1 class="card-section">Case Documents</h1>
        
        <!-- Sort Button Section -->
        
        <div class="case-details-card">
            <div class="flex">
                <div class="search-container">
                    <input type="text" id="document-search" placeholder="Search documents..." onkeyup="searchDocuments()">
                    
                </div>
                <div class="sort-section">
                    <label for="sort-options">Sort by:</label>
                    <select id="sort-options" onchange="sortDocuments()">
                        <option value="date-desc">Date (Newest)</option>
                        <option value="date-asc">Date (Oldest)</option>
                        <option value="name-asc">Name (A-Z)</option>
                        <option value="name-desc">Name (Z-A)</option>
                    </select>
                </div>

                <div class="filter-container">
                    <label for="filter-options">Filter:</label>
                    <select id="filter-options" onchange="filterDocuments()">
                        <option value="all">All Documents</option>
                        <option value="my-uploads">Uploaded by me</option>
                    </select>
                </div>
            </div>
            

            <div class="document-container">
                
                <!-- Upload Button Section -->
                <div class="upload-section">
                    <button class="upload-button" onclick="handleUpload()">
                        <i class='bx bx-plus'></i> <p>Upload</p>
                    </button>
                </div>
                
                <div class="transaction-header">
                    <div>Description</div>
                    <div>Date</div>
                    <div>Uploaded By</div>
                    <div>Receipt</div>
                    <div>Actions</div>
                </div>
                
                <!-- Loop through the documents and display each one -->
                <?php if (!empty($documents)): ?>
                    <?php foreach ($documents as $document): ?>
                        <div class="transaction-row">
                            <div class="transaction-description"><?php echo htmlspecialchars($document->doc_name); ?></div>
                            <div class="transaction-date"><?php echo htmlspecialchars($document->uploaded_at); ?></div>
                            <div class="transaction-uploader"><?php echo htmlspecialchars($document->uploaded_by); ?></div>
                            <div><a href="<?= ROOT ?>/assets/documents/<?= $document->file_path ?>" download class="download-button">Download</a></div>
                            <div class="action-buttons">
                                <button class="edit-button" onclick="handleEdit(<?php echo $document->document_id; ?>)">
                                    <i class='bx bx-edit-alt'></i>
                                </button>
                                <button class="delete-button" onclick="confirmDelete(<?php echo $document->document_id; ?>)">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No documents found for this case.</p>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
    
    <!-- JavaScript Section -->
    <script>
        function confirmDelete(documentId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this document? This action cannot be undone!",
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
                    window.location.href = "<?= ROOT ?>/document/deleteDocument/" + documentId;
                }
            });
        }
        
        function handleEdit(documentId) {
            // Redirect to the edit page
            window.location.href = "<?= ROOT ?>/document/editDocument/" + documentId;
        }
        
        function handleUpload() {
            // Redirect to the upload page
            window.location.href = "<?= ROOT ?>/document/add_Document";
        }
        function sortDocuments() {
        const sortOption = document.getElementById("sort-options").value;
        const rows = Array.from(document.querySelectorAll(".transaction-row"));
        const container = document.querySelector(".document-container");
        
        // Get the header and upload button elements
        const header = document.querySelector(".transaction-header");
        const uploadSection = document.querySelector(".upload-section");
        
        rows.sort((a, b) => {
            const nameA = a.querySelector(".transaction-description").textContent.trim().toLowerCase();
            const nameB = b.querySelector(".transaction-description").textContent.trim().toLowerCase();
            
            // Improved date parsing
            const dateStrA = a.querySelector(".transaction-date").textContent.trim();
            const dateStrB = b.querySelector(".transaction-date").textContent.trim();
            
            // Parse dates properly - this handles various date formats better
            const dateA = new Date(dateStrA);
            const dateB = new Date(dateStrB);
            
            // Check if dates are valid
            const isValidDateA = !isNaN(dateA.getTime());
            const isValidDateB = !isNaN(dateB.getTime());
            
            switch (sortOption) {
                case "date-desc":
                    if (isValidDateA && isValidDateB) return dateB - dateA;
                    return 0;
                case "date-asc":
                    if (isValidDateA && isValidDateB) return dateA - dateB;
                    return 0;
                case "name-asc":
                    return nameA.localeCompare(nameB);
                case "name-desc":
                    return nameB.localeCompare(nameA);
            }
        });
        
        // Remove all rows from container
        const rowsParent = rows[0].parentNode;
        rows.forEach(row => rowsParent.removeChild(row));
        
        // Append the header and upload section first (if they were removed)
        if (!container.contains(header)) {
            container.appendChild(header);
        }
        if (!container.contains(uploadSection)) {
            container.appendChild(uploadSection);
        }
        
        // Then append all sorted rows
        rows.forEach(row => rowsParent.appendChild(row));
    }

        function searchDocuments() {
        const searchTerm = document.getElementById("document-search").value.toLowerCase();
        const rows = document.querySelectorAll(".transaction-row");
        let hasResults = false;
        
        rows.forEach(row => {
            const description = row.querySelector(".transaction-description").textContent.toLowerCase();
            const uploader = row.querySelector(".transaction-uploader").textContent.toLowerCase();
            const date = row.querySelector(".transaction-date").textContent.toLowerCase();
            
            // Check if the search term is found in any of the fields
            if (description.includes(searchTerm) || 
                uploader.includes(searchTerm) || 
                date.includes(searchTerm)) {
                row.style.display = ""; // Show the row
                hasResults = true;
                
                // Add highlight effect
                if (searchTerm.length > 0) {
                    row.classList.add("highlight");
                } else {
                    row.classList.remove("highlight");
                }
            } else {
                row.style.display = "none"; // Hide the row
                row.classList.remove("highlight");
            }
        });
        
        // Show or hide the "No results" message
        let noResultsElement = document.getElementById("no-search-results");
        
        if (!hasResults && searchTerm.length > 0) {
            if (!noResultsElement) {
                noResultsElement = document.createElement("p");
                noResultsElement.id = "no-search-results";
                noResultsElement.classList.add("no-results-message");
                noResultsElement.textContent = "No documents match your search criteria.";
                document.querySelector(".document-container").appendChild(noResultsElement);
            }
            noResultsElement.style.display = "block";
        } else if (noResultsElement) {
            noResultsElement.style.display = "none";
        }
    }

        function getCurrentUser() {
            // This is a placeholder - you should replace this with how you get the current user in your system
            // For example, you might have a global PHP variable you can access via JavaScript
            // If you're using PHP sessions, you might use something like:
            // return '<?php echo $_SESSION['user_name']; ?>';
            
            // For now, let's assume we have a hidden input field with the current user's name
            const userElement = document.getElementById('current-user');
            return userElement ? userElement.value : null;
        }


    </script>
</body>
</html>