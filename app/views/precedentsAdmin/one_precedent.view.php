<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precedent Details</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Poppins:wght@400;700&display=swap');

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
            gap: 15px;
        }

        .info-row, .info-item {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px
        }

        .info-item strong {
            color: #555;
        }

        .info-item p {
            /* margin: 0; */
            color: #333;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
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
        a{
            color: #3f51b5;
            text-decoration: none;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 0px;
        }

        @media (max-width: 768px) {
            .info-row {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="case-details-card">
        <h2 class="card-title">Precedent Details</h2>
        <div class="card-content">
            <div class="info-row">
                <div class="info-item">
                    <strong>Date:</strong>
                    <p><?= htmlspecialchars($case->judgment_date) ?></p>
                </div>
                <div class="info-item">
                    <strong>Case Number:</strong>
                    <p><?= htmlspecialchars($case->case_number) ?></p>
                </div>
                <div class="info-item">
                    <strong>Description:</strong>
                    <p><?= htmlspecialchars($case->description) ?></p>
                </div>
                <div class="info-item">
                    <strong>Judgment By:</strong>
                    <p><?= htmlspecialchars($case->judgment_by) ?></p>
                </div>
                <div class="info-item">
                    <strong>Document:</strong>
                    <a href="<?php echo $case->document_link; ?>" target="_blank">View Document</a>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="<?= ROOT ?>/PrecedentsController/edit/<?= $case->id ?>" class="btn btn-edit">Edit Case</a>
            <a href="javascript:void(0);" onclick="confirmDelete(<?= $case->id; ?>)" class="btn btn-delete">Delete Case</a>
        </div>
    </div>
</body>

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
                    window.location.href = `<?= ROOT ?>/PrecedentsController/deletePrecedent/${caseId}`;
                }
            });
        }
    </script>
</html>
