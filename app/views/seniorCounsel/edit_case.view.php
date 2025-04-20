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

        <div class="form-section">
            <h2>Case: <?= htmlspecialchars($case->case_number) ?></h2>

            <div class="form-container">
                <!-- Client Information -->
                <div class="client-info">
                    <div class="section-title">Client Information</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="client_name">Client Name</label>
                            <input type="text" name="client_name" value="<?= htmlspecialchars($case->client_name) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="client_number">Client Number</label>
                            <input type="text" name="client_number" value="<?= htmlspecialchars($case->client_number) ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="client_email">Client Email</label>
                            <input type="email" name="client_email" value="<?= htmlspecialchars($case->client_email) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="client_address">Client Address</label>
                            <input type="text" name="client_address" value="<?= htmlspecialchars($case->client_address) ?>" required>
                        </div>
                    </div>
                </div>

                <!-- Counsel Information -->
                <div class="counsel-info">
                    <div class="section-title">Counsel Information</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="attorney_name">Attorney Name</label>
                            <select name="attorney_name" required>
                                <option value="<?= htmlspecialchars($case->attorney_name) ?>"><?= htmlspecialchars($case->attorney_name) ?></option>
                                <?php if (isset($attorneys) && is_array($attorneys)): ?>
                                    <?php foreach ($attorneys as $attorney): ?>
                                        <?php $fullName = $attorney->first_name . ' ' . $attorney->last_name; ?>
                                        <?php if ($fullName != $case->attorney_name): ?>
                                            <option value="<?= $fullName ?>"><?= $fullName ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="junior_counsel_name">Junior Counsel Name</label>
                            <select name="junior_counsel_name" required>
                                <option value="<?= htmlspecialchars($case->junior_counsel_name) ?>"><?= htmlspecialchars($case->junior_counsel_name) ?></option>
                                <?php if (isset($juniors) && is_array($juniors)): ?>
                                    <?php foreach ($juniors as $junior): ?>
                                        <?php $fullName = $junior->first_name . ' ' . $junior->last_name; ?>
                                        <?php if ($fullName != $case->junior_counsel_name): ?>
                                            <option value="<?= $fullName ?>"><?= $fullName ?></option>
                                        <?php endif; ?>
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

</body>

</html>