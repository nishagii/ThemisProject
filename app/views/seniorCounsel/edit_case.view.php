<?php
// Assuming $case is the case object passed from the controller to this view
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

    input,
    textarea {
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
    <form action="<?= ROOT ?>/cases/updateCase" method="POST">
        <input type="hidden" name="id" value="<?= $case->id ?>">

        <div class="form-section">
            <h2>Edit Case</h2>

            <div class="form-row">
                <div class="form-group">
                    <label for="client_name">Client Name:</label>
                    <input type="text" name="client_name" value="<?= htmlspecialchars($case->client_name) ?>" required>
                </div>

                <div class="form-group">
                    <label for="client_number">Client Number:</label>
                    <input type="text" name="client_number" value="<?= htmlspecialchars($case->client_number) ?>" required>
                </div>
            </div>

            <div class="form-row">
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
            </div>

            <div class="form-row">
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
            </div>

            <div class="form-row">
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