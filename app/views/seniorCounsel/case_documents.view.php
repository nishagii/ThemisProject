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
            <div class="sort-section">
                <label for="sort-options">Sort by:</label>
                <select id="sort-options" onchange="sortDocuments()">
                    <option value="date-desc">Date (Newest)</option>
                    <option value="date-asc">Date (Oldest)</option>
                    <option value="name-asc">Name (A-Z)</option>
                    <option value="name-desc">Name (Z-A)</option>
                </select>
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

        rows.sort((a, b) => {
            const nameA = a.querySelector(".transaction-description").textContent.trim().toLowerCase();
            const nameB = b.querySelector(".transaction-description").textContent.trim().toLowerCase();
            const dateA = new Date(a.querySelector(".transaction-date").textContent.trim());
            const dateB = new Date(b.querySelector(".transaction-date").textContent.trim());

            switch (sortOption) {
                case "date-desc":
                    return dateB - dateA;
                case "date-asc":
                    return dateA - dateB;
                case "name-asc":
                    return nameA.localeCompare(nameB);
                case "name-desc":
                    return nameB.localeCompare(nameA);
            }
        });

        rows.forEach(row => container.appendChild(row));
    }

    </script>
</body>
</html>