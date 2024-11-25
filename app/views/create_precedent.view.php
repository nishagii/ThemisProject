<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Precedent</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/precedent.css">
</head>
<body>
    <div class="header">
        <h1>Add New Precedent</h1>
    </div>

    <div class="form-container">
        <form method="POST" action="<?= ROOT ?>/PrecedentsController/create">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="judgment_date" required>
            </div>

            <div class="form-group">
                <label for="case_number">Case Number:</label>
                <input type="text" id="case_number" name="case_number" required>
            </div>

            <div class="form-group">
                <label for="parties">Name of Parties:</label>
                <textarea id="parties" name="parties" required></textarea>
            </div>

            <div class="form-group">
                <label for="judgment_by">Judgment by:</label>
                <input type="text" id="judgment_by" name="judgment_by" required>
            </div>

            <div class="form-group">
                <label for="document_link">Document Link:</label>
                <input type="text" id="document_link" name="document_link" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Save Precedent</button>
                <a href="<?= ROOT ?>/precedents" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>