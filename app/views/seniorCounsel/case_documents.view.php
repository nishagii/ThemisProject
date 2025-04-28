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
        <div class="back-button-container">
            <a href="<?= ROOT ?>/cases/retrieveCase/<?php echo htmlspecialchars($case_id); ?> ">
            <button class="back-button">
                <i class='bx bx-arrow-back'></i>
            </button>
            </a>
        </div>

        <h1 class="card-section">Case ID: <?php echo htmlspecialchars($case_id); ?> Documents</h1>
        
        <!-- Sort Button Section -->
        
        <div class="case-details-card">
            
            

            <div class="document-container">
                
                <!-- Upload Button Section -->
                <div class="upload-section">
                    <button class="upload-button" onclick="handleUpload('<?php echo htmlspecialchars($case_id); ?>')">
                        <i class='bx bx-plus'></i> <p>Upload</p>
                    </button>
                </div>
                
                <div class="transaction-header">
                    <div>Description</div>
                    <div>Date</div>
                   
                    <div>Receipt</div>
                    <div> </div>
                </div>
                
               
                <?php if (!empty($documents)): ?>
                    <?php foreach ($documents as $document): ?>
                        <div class="transaction-row">
                            <div class="transaction-description"><?php echo htmlspecialchars($document->doc_name); ?></div>
                            <div class="transaction-date"><?php echo htmlspecialchars($document->uploaded_at); ?></div>
                            
                            <div><a href="<?= ROOT ?>/assets/documents/<?= $document->file_path ?>" download class="download-button">Download</a></div>
                            <div class="action-buttons">
                                <?php if ($document->uploaded_by == $_SESSION['user_id']): ?>
                                   
                                    <button class="edit-button" onclick="handleEdit(<?php echo $document->document_id; ?>)">
                                        <i class='bx bx-edit-alt'></i>
                                    </button>
                                    <button class="delete-button" onclick="confirmDelete(<?php echo $document->document_id; ?>)">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No documents found for this case.</p>
                <?php endif; ?>

                
            </div>
        </div>
    </div>
    

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
                   
                    window.location.href = "<?= ROOT ?>/document/deleteDocument/" + documentId;
                }
            });
        }
        
        function handleEdit(documentId) {
           
            window.location.href = "<?= ROOT ?>/document/editDocument/" + documentId;
        }
        
        function handleUpload(case_id) {
          
            window.location.href = "<?= ROOT ?>/document/add_Document/" + case_id;
        }
        function sortDocuments() {
        const sortOption = document.getElementById("sort-options").value;
        const rows = Array.from(document.querySelectorAll(".transaction-row"));
        const container = document.querySelector(".document-container");
      
        const header = document.querySelector(".transaction-header");
        const uploadSection = document.querySelector(".upload-section");
        
        rows.sort((a, b) => {
            const nameA = a.querySelector(".transaction-description").textContent.trim().toLowerCase();
            const nameB = b.querySelector(".transaction-description").textContent.trim().toLowerCase();
            
           
            const dateStrA = a.querySelector(".transaction-date").textContent.trim();
            const dateStrB = b.querySelector(".transaction-date").textContent.trim();
            
            
            const dateA = new Date(dateStrA);
            const dateB = new Date(dateStrB);
            
        
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
        
       
        const rowsParent = rows[0].parentNode;
        rows.forEach(row => rowsParent.removeChild(row));
        
       
        if (!container.contains(header)) {
            container.appendChild(header);
        }
        if (!container.contains(uploadSection)) {
            container.appendChild(uploadSection);
        }
        
     
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

        
        // Function to get the current user's information
        // This uses PHP to directly inject the username value into JavaScript
        function getCurrentUser() {
            // This will be replaced with the actual username value when PHP processes the file
            return '<?php echo htmlspecialchars($username ?? ""); ?>';
        }

        // Similarly, if you need the user ID
        function getCurrentUserId() {
            return '<?php echo htmlspecialchars($user_id ?? ""); ?>';
        }

        // Your filter function using the direct PHP variable
        function filterDocuments() {
            const filterOption = document.getElementById('filter-options').value;
            const rows = document.querySelectorAll('.transaction-row');
            let hasResults = false;
            
            // Get current username directly from PHP variable
            const currentUser = '<?php echo htmlspecialchars($username ?? ""); ?>'.toLowerCase();
            
            rows.forEach(row => {
                // First, apply any existing search filter
                const searchTerm = document.getElementById('document-search').value.toLowerCase();
                const description = row.querySelector('.transaction-description').textContent.toLowerCase();
                const uploader = row.querySelector('.transaction-uploader').textContent.toLowerCase();
                const date = row.querySelector('.transaction-date').textContent.toLowerCase();
                
                let matchesSearch = true;
                
                if (searchTerm.length > 0) {
                    matchesSearch = description.includes(searchTerm) || 
                                uploader.includes(searchTerm) || 
                                date.includes(searchTerm);
                }
                
                // Then apply user filter
                let matchesFilter = true;
                
                if (filterOption === 'my-uploads') {
                    matchesFilter = uploader.trim() === currentUser;
                }
                
                // Show row only if it matches both filters
                if (matchesSearch && matchesFilter) {
                    row.style.display = '';
                    hasResults = true;
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Update no results message
            let noResultsElement = document.getElementById('no-search-results');
            
            if (!hasResults) {
                if (!noResultsElement) {
                    noResultsElement = document.createElement('p');
                    noResultsElement.id = 'no-search-results';
                    noResultsElement.classList.add('no-results-message');
                    noResultsElement.textContent = 'No documents match your criteria.';
                    document.querySelector('.document-container').appendChild(noResultsElement);
                }
                noResultsElement.style.display = 'block';
            } else if (noResultsElement) {
                noResultsElement.style.display = 'none';
            }
        }
    </script>
</body>
</html>