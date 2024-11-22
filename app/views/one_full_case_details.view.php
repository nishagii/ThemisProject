<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');

    /* General Styles */
    body {
        font-family: 'Montserrat', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #E4E9F7;
    }

    .case-details-card {
        background-color: #f1f1f1;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        overflow: hidden;
    }

    .card-title {
        text-align: center;
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    .card-content {
        display: flex;
        flex-direction: column;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .info-item {
        width: 48%;
    }

    .info-item strong {
        display: block;
        font-weight: bold;
        color: #555;
    }

    .info-item p {
        margin: 5px 0;
        color: #333;
    }

    .card-footer {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .card-footer .btn {
        padding: 10px 20px;
        font-size: 14px;
        border-radius: 4px;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-edit {
        background-color: #4CAF50;
        color: white;
    }

    .btn-edit:hover {
        background-color: #45a049;
    }

    .btn-delete {
        background-color: #f44336;
        color: white;
    }

    .btn-delete:hover {
        background-color: #e53935;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .info-row {
            flex-direction: column;
        }

        .info-item {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>


<body>
    <div class="case-details-card">
        <h2 class="card-title">Case Details</h2>
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