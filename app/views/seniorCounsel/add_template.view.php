<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New template</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/precedentsAdmin/create_precedent.css">
</head>

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    <div class="home-section">
        <div class="header">
            <h1>Add New Template</h1>
        </div>
        <div class="form-container">
            <form method="POST"
                id="templateForm"
                action="<?= ROOT ?>/Template/create"
                enctype="multipart/form-data"
                novalidate>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    <div class="error" id="nameError"></div>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required></textarea>
                    <div class="error" id="descriptionError"></div>
                </div>

                <div class="form-group">
                    <label for="document_link">Template document:</label>
                    <input type="file" id="document_link" name="document_link" required>
                    <div class="error" id="documentLinkError"></div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Save Template</button>
                    <a href="<?= ROOT ?>/Template/create" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Form Validation
        document.getElementById('templateForm').addEventListener('submit', function(event) {
            // Get form fields
            const name = document.getElementById('name').value.trim();
            const description = document.getElementById('description').value.trim();
            const documentLink = document.getElementById('document_link').value.trim();

            // Error elements
            const nameError = document.getElementById('nameError');
            const descriptionError = document.getElementById('descriptionError');
            const documentLinkError = document.getElementById('documentLinkError');

            // Reset error messages
            nameError.textContent = '';
            descriptionError.textContent = '';
            documentLinkError.textContent = '';

            // Flag to check if form is valid
            let isValid = true;

            // Validation checks
            if (!name) {
                nameError.textContent = 'template name is required.';
                isValid = false;
            }
            if (!description) {
                descriptionError.textContent = 'description is required.';
                isValid = false;
            }
            if (!documentLink) {
                documentLinkError.textContent = 'Document is required.';
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