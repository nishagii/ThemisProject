<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New SC Rule</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/precedentsAdmin/create_precedent.css">
</head>
<body>
    <?php include('components/bigNav.view.php'); ?>
    <div class="header">
        <h1>Add New SC Rule</h1>
    </div>

    <div class="form-container">
        <form method="POST" 
        id="scRulesForm" 
        action="<?= ROOT ?>/SCrules/create" 
        enctype="multipart/form-data"
        novalidate>

            <div class="form-group">
                <label for="rule_number">Rule Number:</label>
                <input type="text" id="rule_number" name="rule_number" required>
                <div class="error" id="ruleNumberError"></div>
            </div>

            <div class="form-group">
                <label for="date">Published Date:</label>
                <input type="date" id="date" name="published_date" max="" required>
                <div class="error" id="dateError"></div>
            </div>

            <div class="form-group">
                <label for="sinhala_link">Sinlaha document:</label>
                <input type="file" id="sinhala_link" name="sinhala_link" required>
                <div class="error" id="sinhalaLinkError"></div>
            </div>

            <div class="form-group">
                <label for="tamil_link">Tamil document:</label>
                <input type="file" id="tamil_link" name="tamil_link" required>
                <div class="error" id="tamilLinkError"></div>
            </div>

            <div class="form-group">
                <label for="english_link">English document:</label>
                <input type="file" id="english_link" name="english_link" required>
                <div class="error" id="englishLinkError"></div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Save SC Rule</button>
                <a href="<?= ROOT ?>/SCrules/create" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
    <script>
        
        window.addEventListener('DOMContentLoaded', function () {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').setAttribute('max', today);
        });
        
        // Form Validation
        document.getElementById('scRulesForm').addEventListener('submit', function(event) {
            // Get form fields
            const ruleNumber = document.getElementById('rule_number').value.trim();
            const date = document.getElementById('date').value;
            const sinhalaLink = document.getElementById('sinhala_link').value.trim();
            const TamilLink = document.getElementById('tamil_link').value.trim();
            const englishLink = document.getElementById('english_link').value.trim();

            // Error elements
            const ruleNumberError = document.getElementById('ruleNumberError');
            const dateError = document.getElementById('dateError');
            const sinhalaLinkError = document.getElementById('sinhalaLinkError');
            const tamilLinkError = document.getElementById('tamilLinkError');
            const englishLinkError = document.getElementById('englishLinkError');

            // Reset error messages
            ruleNumberError.textContent = '';
            dateError.textContent = '';
            sinhalaLinkError.textContent = '';
            tamilLinkError.textContent = '';
            englishLinkError.textContent = '';

            // Flag to check if form is valid
            let isValid = ture;

            // Validation checks
            if (!ruleNumber) {
                ruleNumberError.textContent = 'Rule number is required.';
                isValid = false;
            }
            if (!date) {
                dateError.textContent = 'Published Date is required.';
                isValid = false;
            }
            if (!sinhalaLink) {
                sinhalaLinkError.textContent = 'Sinhala document is required.';
                isValid = false;
            }
            if (!tamilLink) {
                tamilLinkError.textContent = 'Tamil document is required.';
                isValid = false;
            }
            if (!englishLink) {
                englishLinkError.textContent = 'English document is required.';
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