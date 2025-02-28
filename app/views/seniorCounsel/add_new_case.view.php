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
                Fill this form details to add a new case to the system. Please ensure the Emails and Phone numbers are correct.
                <span style="color: #fa9800; font-weight: bold;">Emails</span> and
                <span style="color: #fa9800; font-weight: bold;">Phone numbers</span> are correct.
            </div>
            <form method="POST" action="<?= ROOT ?>/cases/addCase">
                <div class="case-forms">
                    <!-- Client Section -->
                    <div class="form-container">
                        <h2>Client</h2>
                        <div class="form-group">
                            <label for="client_name">Name</label>
                            <input
                                id="client_name"
                                name="client_name"
                                type="text"
                                placeholder="Enter name" />
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

                    <!-- Instructing Attorney Section -->
                    <div class="form-container">
                        <h2>Instructing Attorney</h2>
                        <div class="form-group">
                            <label for="attorney_name">Name</label>
                            <input
                                id="attorney_name"
                                type="text"
                                name="attorney_name"
                                placeholder="Enter name" />
                        </div>
                        <div class="form-group">
                            <label for="attorney_number">WhatsApp Number</label>
                            <input
                                id="attorney_number"
                                type="text"
                                name="attorney_number"
                                placeholder="Enter WhatsApp number" />
                        </div>
                        <div class="form-group">
                            <label for="attorney_email">Email</label>
                            <input
                                id="attorney_email"
                                type="email"
                                name="attorney_email"
                                placeholder="Enter Email address" />
                        </div>
                        <div class="form-group">
                            <label for="attorney_address">Address</label>
                            <input
                                id="attorney_address"
                                type="text"
                                name="attorney_address"
                                placeholder="Enter Address" />
                        </div>
                    </div>

                    <!-- Junior Counsel Section -->
                    <div class="form-container">
                        <h2>Junior Counsel</h2>
                        <div class="form-group">
                            <label for="junior_counsel_name">Name</label>
                            <input
                                id="junior_counsel_name"
                                type="text"
                                name="junior_counsel_name"
                                placeholder="Enter name" />
                        </div>
                        <div class="form-group">
                            <label for="junior_counsel_number">WhatsApp Number</label>
                            <input
                                id="junior_counsel_number"
                                type="text"
                                name="junior_counsel_number"
                                placeholder="Enter WhatsApp number" />
                        </div>
                        <div class="form-group">
                            <label for="junior_counsel_email">Email</label>
                            <input
                                id="junior_counsel_email"
                                type="email"
                                name="junior_counsel_email"
                                placeholder="Enter Email address" />
                        </div>
                        <div class="form-group">
                            <label for="junior_counsel_address">Address</label>
                            <input
                                id="junior_counsel_address"
                                type="text"
                                name="junior_counsel_address"
                                placeholder="Enter Address" />
                        </div>
                    </div>
                </div>

                <hr class="solid">

                <!-- Additional Details -->
                <div class="large-container">
                    <h2>Additional Details</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="case_number">Case Number</label>
                            <input id="case_number" name="case_number" type="text" placeholder="Enter case number" />
                        </div>
                        <div class="form-group">
                            <label for="court">Court</label>
                            <input id="court" name="court" type="text" placeholder="Enter the court" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea
                            id="notes"
                            name="notes"
                            placeholder="Enter any notes here">
                        </textarea>
                    </div>
                </div>

                <button type="submit" class="add-case-button">Add Case</button>
            </form>
        </section>
    </main>

    <script src="script.js"></script>
    <script src="<?= ROOT ?>/assets/js/seniorCouncel/case_form_validation.js"></script>



</body>

</html>