<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Case</title>
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
</style>

<body>
    <form id="precedentEditForm"action="<?= ROOT ?>/PrecedentsController/updatePrecedent" method="POST" novalidate>
        <input type="hidden" name="id" value="<?= $case->id ?>">

        <div class="form-section">
            <h2>Edit Precedent</h2>
                <div class="form-group">
                    <label for="judgment_date">Date:</label>
                    <input id="judgment_date" type="date"  name="judgment_date" value="<?= htmlspecialchars($case->judgment_date) ?>" required>
                    <div class="error" id="dateError"></div>
                </div>
                <div class="form-group">
                    <label for="case_number">Case Number:</label>
                    <input id="case_number" type="text" name="case_number" value="<?= htmlspecialchars($case->case_number) ?>" required>
                    <div class="error" id="caseNumberError"></div>
                </div>
                <div class="form-group">
                    <label for="name_of_parties">Names of parties:</label>
                    <textarea id="name_of_parties" type="text" name="name_of_parties" value="<?= htmlspecialchars($case->name_of_parties) ?>" required><?= htmlspecialchars($case->name_of_parties) ?></textarea>
                    <div class="error" id="partiesError"></div>
                </div>
                <div class="form-group">
                    <label for="judgment_by">Judgment by:</label>
                    <input id="judgment_by" type="text" name="judgment_by" value="<?= htmlspecialchars($case->judgment_by) ?>" required>
                    <div class="error" id="judgmentByError"></div>
                </div>
                <div class="form-group">
                    <label for="document_link">Document:</label>
                    <input id="document_link" type="text" name="document_link" value="<?= htmlspecialchars($case->document_link) ?>" required>
                    <div class="error" id="documentLinkError"></div>
                </div>

            <div class="form-group">
                <button type="submit" class="submit-button">Update Case</button>
            </div>
        </div>
    </form>
    <script>
        // Form Validation
        document.getElementById('precedentEditForm').addEventListener('submit', function(event) {
            // Get form fields
            const date = document.getElementById('judgment_date').value;
            const caseNumber = document.getElementById('case_number').value.trim();
            const parties = document.getElementById('name_of_parties').value.trim();
            const judgmentBy = document.getElementById('judgment_by').value.trim();
            const documentLink = document.getElementById('document_link').value.trim();

            // Error elements
            const dateError = document.getElementById('dateError');
            const caseNumberError = document.getElementById('caseNumberError');
            const partiesError = document.getElementById('partiesError');
            const judgmentByError = document.getElementById('judgmentByError');
            const documentLinkError = document.getElementById('documentLinkError');

            // Reset error messages
            dateError.textContent = '';
            caseNumberError.textContent = '';
            partiesError.textContent = '';
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
            if (!parties) {
                partiesError.textContent = 'Name of parties is required.';
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