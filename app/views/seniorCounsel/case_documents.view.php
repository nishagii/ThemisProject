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

        <div class="case-details-card">
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
                </div>

                <!-- Loop through the documents and display each one -->
                <?php if (!empty($documents)): ?>
                    <?php foreach ($documents as $document): ?>
                        <div class="transaction-row">
                            <div class="transaction-description"><?php echo htmlspecialchars($document->doc_name); ?></div>
                            <div class="transaction-date"><?php echo htmlspecialchars($document->uploaded_at); ?></div> <!-- Assuming you have upload_date in your model -->
                            <div class="transaction-uploader"><?php echo htmlspecialchars($document->uploaded_by); ?></div>
                            <div><a href="<?= ROOT ?>/assets/documents/<?= $document->file_path ?>" download class="download-button">Download</a></div>
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
        function confirmDelete(caseId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this case? This action cannot be undone!",
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
                    window.location.href = "<?= ROOT ?>/document/deleteDocument/" + caseId;
                }
            });
        }

        function handleUpload() {
            // Redirect to the upload page
            window.location.href = "<?= ROOT ?>/document/add_Document";
        }
    </script>

</body>

</html>
