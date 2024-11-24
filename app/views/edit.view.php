<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Precedent</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/precedent.css">
</head>
<body>
    <div class="header">
        <h1>Edit Precedent</h1>
    </div>

    <div class="form-container">
        <form method="POST" action="<?= ROOT ?>/precedents/edit/<?= $precedent->id ?>">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" value="<?= date('Y-m-d', strtotime($precedent->date)) ?>" required>
            </div>

            <div class="form-group">
                <label for="case_number">Case Number:</label>
                <input type="text" id="case_number" name="case_number" value="<?= htmlspecialchars($precedent->case_number) ?>" required>
            </div>

            <div class="form-group">
                <label for="parties">Name of Parties:</label>
                <textarea id="parties" name="parties" required><?= htmlspecialchars($precedent->parties) ?></textarea>
            </div>

            <div class="form-group">
                <label for="judgment_by">Judgment by:</label>
                <input type="text" id="judgment_by" name="judgment_by" value="<?= htmlspecialchars($precedent->judgment_by) ?>" required>
            </div>

            <div class="form-group">
                <label for="document_link">Document Link:</label>
                <input type="text" id="document_link" name="document_link" value="<?= htmlspecialchars($precedent->document_link) ?>" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Update Precedent</button>
                <a href="<?= ROOT ?>/precedents" class="btn-cancel">Cancel</a>
                <a href="<?= ROOT ?>/precedents/delete/<?= $precedent->id ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this precedent?')">Delete Precedent</a>
            </div>
        </form>
    </div>
</body>
</html>