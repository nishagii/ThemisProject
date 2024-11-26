<?php
// Assuming $case is the case object passed from the controller to this view
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Case</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/update_case.css">
</head>

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>

    <h1>
        <div class="edit-section">
            edit case
        </div>
    </h1>
    <form action="<?= ROOT ?>/cases/updateCase" method="POST">
        <input type="hidden" name="id" value="<?= $case->id ?>">

        <div class="form-section">
            <h2>Case : <?= htmlspecialchars($case->case_number) ?></h2>

            <div class="form-row">
                <div class="form-group">
                    <label for="client_name">Client Name:</label>
                    <input type="text" name="client_name" value="<?= htmlspecialchars($case->client_name) ?>" required>
                </div>

                <div class="form-group">
                    <label for="client_number">Client Number:</label>
                    <input type="text" name="client_number" value="<?= htmlspecialchars($case->client_number) ?>" required>
                </div>

                <div class="form-group">
                    <label for="client_email">Client Email:</label>
                    <input type="email" name="client_email" value="<?= htmlspecialchars($case->client_email) ?>" required>
                </div>

                <div class="form-group">
                    <label for="client_address">Client Address:</label>
                    <input type="text" name="client_address" value="<?= htmlspecialchars($case->client_address) ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="attorney_name">Attorney Name:</label>
                    <input type="text" name="attorney_name" value="<?= htmlspecialchars($case->attorney_name) ?>" required>
                </div>

                <div class="form-group">
                    <label for="attorney_number">Attorney Number:</label>
                    <input type="text" name="attorney_number" value="<?= htmlspecialchars($case->attorney_number) ?>" required>
                </div>
        
                <div class="form-group">
                    <label for="attorney_email">Attorney Email:</label>
                    <input type="email" name="attorney_email" value="<?= htmlspecialchars($case->attorney_email) ?>" required>
                </div>

                <div class="form-group">
                    <label for="attorney_address">Attorney Address:</label>
                    <input type="text" name="attorney_address" value="<?= htmlspecialchars($case->attorney_address) ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="junior_counsel_name">Junior Counsel Name:</label>
                    <input type="text" name="junior_counsel_name" value="<?= htmlspecialchars($case->junior_counsel_name) ?>" required>
                </div>

                <div class="form-group">
                    <label for="junior_counsel_number">Junior Counsel Number:</label>
                    <input type="text" name="junior_counsel_number" value="<?= htmlspecialchars($case->junior_counsel_number) ?>" required>
                </div>
          
                <div class="form-group">
                    <label for="junior_counsel_email">Junior Counsel Email:</label>
                    <input type="email" name="junior_counsel_email" value="<?= htmlspecialchars($case->junior_counsel_email) ?>" required>
                </div>

                <div class="form-group">
                    <label for="junior_counsel_address">Junior Counsel Address:</label>
                    <input type="text" name="junior_counsel_address" value="<?= htmlspecialchars($case->junior_counsel_address) ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="case_number">Case Number:</label>
                    <input type="text" name="case_number" value="<?= htmlspecialchars($case->case_number) ?>" required>
                </div>

                <div class="form-group">
                    <label for="court">Court:</label>
                    <input type="text" name="court" value="<?= htmlspecialchars($case->court) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="notes">Notes:</label>
                <textarea name="notes" required><?= htmlspecialchars($case->notes) ?></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-button">Update Case</button>
            </div>
        </div>
    </form>

</body>

</html>