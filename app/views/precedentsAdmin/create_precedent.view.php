<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Precedent</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/precedentsAdmin/create_precedent.css">
</head>
<body>
    <?php include('components/bigNav.view.php'); ?>
    <div class="header">
        <h1>Add New Precedent</h1>
    </div>
    <!-- <a href="<?= ROOT ?>/PrecedentsController/retrieveAll">
        <button class="view-all">View All Precedents</button>
    </a> -->
    <div class="form-container">
        <form method="POST" 
        id="precedentForm" 
        action="<?= ROOT ?>/PrecedentsController/create" 
        enctype="multipart/form-data"
        novalidate>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="judgment_date" max="" required>
                <div class="error" id="dateError"></div>
            </div>

            <div class="form-group">
                <label for="case_number">Case Number:</label>
                <input type="text" id="case_number" name="case_number" required>
                <div class="error" id="caseNumberError"></div>
            </div>

            <div class="form-group">
                <label for="description">Case Description:</label>
                <textarea id="description" name="description" required></textarea>
                <div class="error" id="descriptionError"></div>
            </div>

            <div class="form-group">
                <label for="judgment_by">Judgment by:</label>
                <input type="text" id="judgment_by" name="judgment_by" required>
                <div class="error" id="judgmentByError"></div>
            </div>

            <div class="form-group">
                <label for="document_link">Case document:</label>
                <input type="file" id="document_link" name="document_link" required>
                <div class="error" id="documentLinkError"></div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Save Precedent</button>
                <a href="<?= ROOT ?>/precedentsController/create" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
    <script>
        
        window.addEventListener('DOMContentLoaded', function () {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').setAttribute('max', today);
        });
        
        // Form Validation
        document.getElementById('precedentForm').addEventListener('submit', function(event) {
            // Get form fields
            const date = document.getElementById('date').value;
            const caseNumber = document.getElementById('case_number').value.trim();
            const description = document.getElementById('description').value.trim();
            const judgmentBy = document.getElementById('judgment_by').value.trim();
            const documentLink = document.getElementById('document_link').value.trim();

            // Error elements
            const dateError = document.getElementById('dateError');
            const caseNumberError = document.getElementById('caseNumberError');
            const descriptionError = document.getElementById('descriptionError');
            const judgmentByError = document.getElementById('judgmentByError');
            const documentLinkError = document.getElementById('documentLinkError');

            // Reset error messages
            dateError.textContent = '';
            caseNumberError.textContent = '';
            descriptionError.textContent = '';
            judgmentByError.textContent = '';
            documentLinkError.textContent = '';

            // Flag to check if form is valid
            let isValid = true;

            // Validation checks
            if (!date) {
                dateError.textContent = 'Date is required.';
                isValid = false;
            }
            if (!caseNumber) {
                caseNumberError.textContent = 'Case number is required.';
                isValid = false;
            }
            if (!description) {
                descriptionError.textContent = 'Description is required.';
                isValid = false;
            }
            if (!judgmentBy) {
                judgmentByError.textContent = 'Judgment by is required.';
                isValid = false;
            }
            if (!documentLink) {
                documentLinkError.textContent = 'Document link is required.';
                isValid = false;
            }

            // If form is not valid, prevent submission
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>