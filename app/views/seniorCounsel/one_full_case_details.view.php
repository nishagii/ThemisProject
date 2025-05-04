<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case Details</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/one_case.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>

    <div class="home-section">

        <h1 class="card-section">Case Details</h1>

        <div class="documents-card">
            <p>Click here to add or view case documents</p>
            <a href="<?= ROOT ?>/document/<?= $case->id ?>"><button>Documents</button></a>
        </div>

        <div class="case-details-card">
            <h2 class="card-title"><?= htmlspecialchars($case->client_name) ?> : <?= htmlspecialchars($case->case_number) ?></h2>
            <div class="card-content">
                <div class="info-row">
                    <div class="info-item">
                        <strong>Case Number:</strong>
                        <p><?= htmlspecialchars($case->case_number) ?></p>
                    </div>
                    <div class="info-item">
                        <strong>Client Name:</strong>
                        <p><?= htmlspecialchars($case->client_name) ?></p>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-item">
                        <strong>Client Number:</strong>
                        <p><?= htmlspecialchars($case->client_number) ?></p>
                    </div>
                    <div class="info-item">
                        <strong>Client Email:</strong>
                        <p><?= htmlspecialchars($case->client_email) ?></p>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-item">
                        <strong>Attorney Name:</strong>
                        <p><?= isset($case->attorney_name) ? htmlspecialchars($case->attorney_name) : 'Not assigned' ?></p>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-item">
                        <strong>Junior Counsel Name:</strong>
                        <p><?= isset($case->junior_counsel_name) ? htmlspecialchars($case->junior_counsel_name) : 'Not assigned' ?></p>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-item">
                        <strong>Court:</strong>
                        <p><?= htmlspecialchars($case->court) ?></p>
                    </div>
                    <div class="info-item">
                        <strong>Case Address:</strong>
                        <p><?= htmlspecialchars($case->client_address) ?></p>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-item">
                        <strong>Case Status:</strong>
                        <p><?= htmlspecialchars($case->case_status ?? 'ongoing') ?></p>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-item">
                        <strong>Notes:</strong>
                        <p><?= htmlspecialchars($case->notes) ?></p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?= ROOT ?>/cases/editCase/<?= $case->id; ?>" class="btn btn-edit">Edit Case</a>
                <a href="javascript:void(0);"
                    class="btn btn-delete"
                    onclick="confirmDelete(<?= $case->id; ?>)">
                    Delete Case
                </a>
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
               
                    window.location.href = `<?= ROOT ?>/cases/deleteCase/${caseId}`;
                }
            });
        }
    </script>
</body>

</html>