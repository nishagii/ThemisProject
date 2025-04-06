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

                <!-- Transaction Rows (existing content) -->
                <div class="transaction-row">
                    <div class="transaction-description">Spotify Subscription</div>
                    <div class="transaction-date">28 Jan, 12:30 AM</div>
                    <div class="transaction-uploader">John Doe</div>
                    <div><button class="download-button">Download</button></div>
                </div>

                <!-- Add the rest of your transactions here... -->
                <div class="transaction-row">
                    <div class="transaction-description">Spotify Subscription</div>
                    <div class="transaction-date">28 Jan, 12:30 AM</div>
                    <div class="transaction-uploader">John Doe</div>
                    <div><button class="download-button">Download</button></div>
                </div>
                <div class="transaction-row">
                    <div class="transaction-description">Spotify Subscription</div>
                    <div class="transaction-date">28 Jan, 12:30 AM</div>
                    <div class="transaction-uploader">John Doe</div>
                    <div><button class="download-button">Download</button></div>
                </div>
                <div class="transaction-row">
                    <div class="transaction-description">Spotify Subscription</div>
                    <div class="transaction-date">28 Jan, 12:30 AM</div>
                    <div class="transaction-uploader">John Doe</div>
                    <div><button class="download-button">Download</button></div>
                </div>
                <div class="transaction-row">
                    <div class="transaction-description">Spotify Subscription</div>
                    <div class="transaction-date">28 Jan, 12:30 AM</div>
                    <div class="transaction-uploader">John Doe</div>
                    <div><button class="download-button">Download</button></div>
                </div>

            </div>
        </div>
    </div>


    <!-- -------------------------------------JavaScript------------------------------------- -->
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