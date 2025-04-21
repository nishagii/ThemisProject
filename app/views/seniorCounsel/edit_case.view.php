<?php
// Assuming $case is the case object passed from the controller to this view
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Case</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/update_case.css">
</head>

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>

    <h1>
        <div class="edit-section">
            Edit Case
        </div>
    </h1>

    <form action="<?= ROOT ?>/cases/updateCase" method="POST">
        <input type="hidden" name="id" value="<?= $case->id ?>">
        <!-- Hidden fields for client_id and client_registered -->
        <input type="hidden" id="client_id" name="client_id" value="<?= $case->client_id ?? '' ?>">
        <input type="hidden" id="client_registered" name="client_registered" value="<?= !empty($case->client_id) ? '1' : '0' ?>">

        <div class="form-section">
            <h2>Case: <?= htmlspecialchars($case->case_number) ?></h2>

            <div class="form-container">
                <!-- Client Information -->
                <div class="client-info">
                    <div class="section-title">Client Information</div>

                    <!-- Client Selection -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="existing_client">Select Client</label>
                            <select id="existing_client" name="existing_client" class="form-select" onchange="toggleClientFields()">
                                <option value="new" <?= empty($case->client_id) ? 'selected' : '' ?>>New Client (Not Registered)</option>
                                <?php if (isset($clients) && is_array($clients)): ?>
                                    <?php foreach ($clients as $client): ?>
                                        <option value="<?= $client->id ?>" <?= ($case->client_id == $client->id) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($client->first_name . ' ' . $client->last_name) ?> (<?= htmlspecialchars($client->email) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="client_name">Client Name</label>
                            <input type="text" name="client_name" id="client_name" value="<?= htmlspecialchars($case->client_name) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="client_number">Client Number</label>
                            <input type="text" name="client_number" id="client_number" value="<?= htmlspecialchars($case->client_number) ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="client_email">Client Email</label>
                            <input type="email" name="client_email" id="client_email" value="<?= htmlspecialchars($case->client_email) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="client_address">Client Address</label>
                            <input type="text" name="client_address" id="client_address" value="<?= htmlspecialchars($case->client_address) ?>" required>
                        </div>
                    </div>
                </div>

                <!-- Counsel Information -->
                <div class="counsel-info">
                    <div class="section-title">Counsel Information</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="attorney_id">Attorney Name</label>
                            <select name="attorney_id" id="attorney_id" required>
                                <option value="">Select an attorney</option>
                                <?php if (isset($attorneys) && is_array($attorneys)): ?>
                                    <?php foreach ($attorneys as $attorney): ?>
                                        <?php $selected = ($case->attorney_id == $attorney->id) ? 'selected' : ''; ?>
                                        <option value="<?= $attorney->id ?>" <?= $selected ?>>
                                            <?= htmlspecialchars($attorney->first_name . ' ' . $attorney->last_name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="junior_id">Junior Counsel Name</label>
                            <select name="junior_id" id="junior_id" required>
                                <option value="">Select a junior counsel</option>
                                <?php if (isset($juniors) && is_array($juniors)): ?>
                                    <?php foreach ($juniors as $junior): ?>
                                        <?php $selected = ($case->junior_id == $junior->id) ? 'selected' : ''; ?>
                                        <option value="<?= $junior->id ?>" <?= $selected ?>>
                                            <?= htmlspecialchars($junior->first_name . ' ' . $junior->last_name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Case Details -->
                <div class="case-info">
                    <div class="section-title">Case Details</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="case_number">Case Number</label>
                            <input type="text" name="case_number" value="<?= htmlspecialchars($case->case_number) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="court">Court</label>
                            <input type="text" name="court" value="<?= htmlspecialchars($case->court) ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="case_status">Case Status</label>
                            <select name="case_status" id="case_status">
                                <option value="ongoing" <?= ($case->case_status == 'ongoing' || empty($case->case_status)) ? 'selected' : '' ?>>Ongoing</option>
                                <option value="closed" <?= ($case->case_status == 'closed') ? 'selected' : '' ?>>Closed</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" required><?= htmlspecialchars($case->notes) ?></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-button">Update Case</button>
            </div>
        </div>
    </form>

    <script>
        // Function to toggle client fields based on selection
        function toggleClientFields() {
            const selection = document.getElementById('existing_client').value;
            const clientIdField = document.getElementById('client_id');
            const clientRegisteredField = document.getElementById('client_registered');

            if (selection === 'new') {
                // For new client
                document.getElementById('client_name').readOnly = false;
                document.getElementById('client_number').readOnly = false;
                document.getElementById('client_email').readOnly = false;
                document.getElementById('client_address').readOnly = false;

                // Clear fields
                document.getElementById('client_name').value = '';
                document.getElementById('client_number').value = '';
                document.getElementById('client_email').value = '';
                document.getElementById('client_address').value = '';

                // Update hidden fields
                clientIdField.value = '';
                clientRegisteredField.value = '0';

                // Remove readonly styling
                document.getElementById('client_name').style.backgroundColor = '';
                document.getElementById('client_number').style.backgroundColor = '';
                document.getElementById('client_email').style.backgroundColor = '';
            } else {
                // For existing client
                fetch(`<?= ROOT ?>/users/getUserDetails/${selection}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Fill in client details
                            document.getElementById('client_name').value = data.user.first_name + ' ' + data.user.last_name;
                            document.getElementById('client_number').value = data.user.phone || '';
                            document.getElementById('client_email').value = data.user.email || '';
                            document.getElementById('client_address').value = data.user.address || '';

                            // Make fields readonly
                            document.getElementById('client_name').readOnly = true;
                            document.getElementById('client_number').readOnly = true;
                            document.getElementById('client_email').readOnly = true;
                            document.getElementById('client_address').readOnly = false; // Keep address editable

                            // Update hidden fields
                            clientIdField.value = selection;
                            clientRegisteredField.value = '1';

                            // Add readonly styling
                            document.getElementById('client_name').style.backgroundColor = '#f8f9fa';
                            document.getElementById('client_number').style.backgroundColor = '#f8f9fa';
                            document.getElementById('client_email').style.backgroundColor = '#f8f9fa';
                        } else {
                            console.error('Error fetching user details');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }

        // Initialize form state on page load
        document.addEventListener('DOMContentLoaded', function() {
            // If client is registered, make fields readonly
            if (document.getElementById('client_id').value) {
                document.getElementById('client_name').readOnly = true;
                document.getElementById('client_number').readOnly = true;
                document.getElementById('client_email').readOnly = true;

                // Add readonly styling
                document.getElementById('client_name').style.backgroundColor = '#f8f9fa';
                document.getElementById('client_number').style.backgroundColor = '#f8f9fa';
                document.getElementById('client_email').style.backgroundColor = '#f8f9fa';
            }
        });
    </script>
</body>

</html>