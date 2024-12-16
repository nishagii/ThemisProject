<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Template</title>
</head>

<style>
    :root {
        --primary-color: #2563eb;
        --primary-hover: #1d4ed8;
        --background-color: #f8fafc;
        --form-background: #ffffff;
        --text-color: #1f2937;
        --border-color: #e5e7eb;
        --shadow-color: rgb(0 0 0 / 0.1);
    }

    body {
        background-color: var(--background-color);
        color: var(--text-color);
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        line-height: 1.5;
    }

    .form-section {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: var(--form-background);
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px var(--shadow-color),
            0 2px 4px -2px var(--shadow-color);
    }

    h2 {
        font-size: 1.875rem;
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 2rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--primary-color);
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }

    input, textarea {
        padding: 0.75rem;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        font-size: 1rem;
        transition: all 0.2s ease;
        background-color: var(--background-color);
    }

    input:focus,
    textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    .submit-button {
        background-color: var(--primary-color);
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.2s ease;
        width: 100%;
        margin-top: 1rem;
    }

    .submit-button:hover {
        background-color: var(--primary-hover);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.1);
    }

    .submit-button:active {
        transform: translateY(0);
    }
    .error {
    color: red;
    font-size: 14px;
    margin-top: 5px;
    }
    a{
        color: #3f51b5;
        text-decoration: none;
        font-weight: bold;
        padding-left: 20px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .form-section {
            margin: 1rem;
            padding: 1.5rem;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        input,
        textarea {
            font-size: 16px;
            /* Prevents zoom on mobile */
        }
    }

    /* Modern form field animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-group {
        animation: fadeIn 0.3s ease-out forwards;
    }

    /* Optional: Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--background-color);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary-hover);
    }

    /* Optional: Form validation styles */
    input:invalid,
    textarea:invalid {
        border-color: #ef4444;
    }

    input:invalid:focus,
    textarea:invalid:focus {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    /* Optional: Loading state for submit button */
    .submit-button.loading {
        opacity: 0.7;
        cursor: wait;
    }
    input[type="file"]::file-selector-button {
    background-color: #3f51b5;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    }
</style>

<body>
    <form id="templateEditForm"
    action="<?= ROOT ?>/template/updatetemplate" method="POST" 
    enctype="multipart/form-data"
    novalidate>
        <input type="hidden" name="id" value="<?= $template->id ?>">
        <div class="form-section">
            <h2>Edit Template</h2>
                <div class="form-group">
                    <label for="Name">Name:</label>
                    <input id="Name" type="text" name="Name" value="<?= htmlspecialchars($template->name) ?? '' ?>" required>
                    <div class="error" id="nameError"></div>
                </div>
                <div class="form-group">
                    <label for="Description">Description:</label>
                    <textarea id="Description" type="text" name="Description" value="<?= htmlspecialchars($template->description) ?? '' ?>" required><?= htmlspecialchars($template->description) ?></textarea>
                    <div class="error" id="descriptionError"></div>
                </div>
                <div class="form-group">
                    <label for="document_link">Current Document:</label>
                    <a href="<?= htmlspecialchars($template->document_link) ?>" target="_blank">View Document</a>
                    <input type="hidden" name="current_document_link" value="<?= htmlspecialchars($template->document_link) ?>">
                    <p><b>Or upload a new document (optional):</b></p>
                    <input id="document_upload" type="file" name="document_upload">
                    <div class="error" id="documentLinkError"></div>
                </div>

            <div class="form-group">
                <button type="submit" class="submit-button">Update Template</button>
            </div>
        </div>
    </form>
    <script>
        // Form Validation
        document.getElementById('templateEditForm').addEventListener('submit', function(event) {
            // Get form fields
            const name = document.getElementById('Name').value.trim();
            const description = document.getElementById('Description').value.trim();

            // Error elements
            const nameError = document.getElementById('nameError');
            const descriptionError = document.getElementById('descriptionError');
            
            // Reset error messages
            nameError.textContent = '';
            descriptionError.textContent = '';

            // Flag to check if form is valid
            let isValid = true;

            // Validation checks
            if (!name) {
                nameError.textContent = 'template name is required.';
                isValid = false;
            }
            if (!description) {
                descriptionError.textContent = 'Description is required.';
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