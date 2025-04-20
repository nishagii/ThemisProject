<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Case</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/addnewcase.css" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    <main class="home-section">
        <?php if (!empty($errors)): ?>
            <div class="error-container">
                <?php foreach ($errors as $field => $error): ?>
                    <p><?= ucfirst($field) ?>: <?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <section class="new-case-section">
            <div class="new-case-header">
                <h1>Add New Case</h1>
            </div>
            <div class="paragraph-add-case">
                Fill this form details to add a new case to the system. Please ensure the
                <span style="color: #fa9800; font-weight: bold;">Emails</span> and
                <span style="color: #fa9800; font-weight: bold;">Phone numbers</span> are correct.
            </div>

            <form method="POST" action="<?= ROOT ?>/cases/addCase">
                <div class="form-layout">
                    <!-- Left Column -->
                    <div class="form-column">
                        <!-- Client Section -->
                        <div class="form-container">
                            <h2>Client Information</h2>
                            <div class="form-group">
                                <label for="client_name">Name</label>
                                <input
                                    id="client_name"
                                    name="client_name"
                                    type="text"
                                    placeholder="Enter client name" />
                            </div>
                            <div class="form-group">
                                <label for="client_number">WhatsApp Number</label>
                                <input
                                    id="client_number"
                                    name="client_number"
                                    type="text"
                                    placeholder="Enter WhatsApp number" />
                            </div>
                            <div class="form-group">
                                <label for="client_email">Email</label>
                                <input
                                    id="client_email"
                                    type="email"
                                    name="client_email"
                                    placeholder="Enter Email address" />
                            </div>
                            <div class="form-group">
                                <label for="client_address">Address</label>
                                <input
                                    id="client_address"
                                    type="text"
                                    name="client_address"
                                    placeholder="Enter Address" />
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="form-column">
                        <!-- Instructing Attorney Section -->
                        <div class="form-container">
                            <h2>Instructing Attorney</h2>
                            <div class="form-group">
                                <label for="attorney_name">Select Attorney</label>
                                <select id="attorney_name" name="attorney_name" class="form-select">
                                    <option value="">Select an attorney</option>
                                    <?php if (isset($attorneys) && is_array($attorneys)): ?>
                                        <?php foreach ($attorneys as $attorney): ?>
                                            <option value="<?= $attorney->first_name . ' ' . $attorney->last_name ?>">
                                                <?= $attorney->first_name . ' ' . $attorney->last_name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Junior Counsel Section -->
                        <div class="form-container">
                            <h2>Junior Counsel</h2>
                            <div class="form-group">
                                <label for="junior_counsel_name">Select Junior Counsel</label>
                                <select id="junior_counsel_name" name="junior_counsel_name" class="form-select">
                                    <option value="">Select a junior counsel</option>
                                    <?php if (isset($juniors) && is_array($juniors)): ?>
                                        <?php foreach ($juniors as $junior): ?>
                                            <option value="<?= $junior->first_name . ' ' . $junior->last_name ?>">
                                                <?= $junior->first_name . ' ' . $junior->last_name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Case Details Section -->
                        <div class="form-container">
                            <h2>Case Details</h2>
                            <div class="form-group">
                                <label for="case_number">Case Number</label>
                                <input id="case_number" name="case_number" type="text" placeholder="Enter case number" />
                            </div>
                            <div class="form-group">
                                <label for="court">Court</label>
                                <input id="court" name="court" type="text" placeholder="Enter the court" />
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea
                                    id="notes"
                                    name="notes"
                                    placeholder="Enter any notes here"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="add-case-button">Add Case</button>
            </form>
        </section>
    </main>

    <script src="<?= ROOT ?>/assets/js/seniorCouncel/case_form_validation.js"></script>
</body>

</html>