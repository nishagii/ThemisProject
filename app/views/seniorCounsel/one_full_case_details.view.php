<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/one_case.css">
</head>




<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>

    <h1 class="card-section">Case Details</h1>

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
                    <p><?= htmlspecialchars($case->attorney_name) ?></p>
                </div>
                <div class="info-item">
                    <strong>Attorney Email:</strong>
                    <p><?= htmlspecialchars($case->attorney_email) ?></p>
                </div>
            </div>
            <div class="info-row">
                <div class="info-item">
                    <strong>Junior Counsel Name:</strong>
                    <p><?= htmlspecialchars($case->junior_counsel_name) ?></p>
                </div>
                <div class="info-item">
                    <strong>Junior Counsel Email:</strong>
                    <p><?= htmlspecialchars($case->junior_counsel_email) ?></p>
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
                    <strong>Attorney Address:</strong>
                    <p><?= htmlspecialchars($case->attorney_address) ?></p>
                </div>
                <div class="info-item">
                    <strong>Junior Counsel Address:</strong>
                    <p><?= htmlspecialchars($case->junior_counsel_address) ?></p>
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
            <a href="<?= ROOT ?>/cases/deleteCase/<?= $case->id; ?>" class="btn btn-delete">Delete Case</a>
        </div>
    </div>

</body>

</html>