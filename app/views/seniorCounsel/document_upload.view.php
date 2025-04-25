<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/one_case.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/document_upload.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>




<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>

    <div class="home-section">
        <h1 class="card-section">Upload Documents for Case ID: <?= $case_id ?></h1>


        <div class="case-details-card">
            <form action="<?= ROOT ?>/document/save_Document" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="case_id" value="<?= $case_id ?>">

                <div class="form-group">
                    <label for="docName">Document Name</label>
                    <input type="text" id="docName" name="doc_name" required>
                </div>

                <div class="form-group">
                    <label for="docDescription">Description</label>
                    <textarea id="docDescription" name="doc_description" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="fileUpload">Upload Document</label> <small style="color: #777;">Max size: 10MB</small>
                    <input type="file" id="fileUpload" name="document_file" required>
                </div>

                <button type="submit" class="btn-submit">Upload Document</button>
            </form>
        </div>
    </div>


    <!-- -------------------------------------JavaScript------------------------------------- -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector("form");
            const fileInput = document.getElementById("fileUpload");

            form.addEventListener("submit", function (e) {
                const maxSize = 10 * 1024 * 1024; // 5MB
                const file = fileInput.files[0];

                if (file && file.size > maxSize) {
                    e.preventDefault(); // Stop form submission
                    Swal.fire({
                        icon: 'error',
                        title: 'File too large!',
                        text: 'Please upload a file smaller than 10MB.',
                        background: '#fafafa',
                        color: '#1d1b31',
                    });
                }
            });
        });
    </script>



</body>

</html>