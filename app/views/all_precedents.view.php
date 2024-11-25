<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Precedents</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/all_precedents.css">
</head>
<body>
    <div class="header">
        <h1>All Precedents</h1>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Case Number</th>
                    <th>Name of Parties</th>
                    <th>Judgment By</th>
                    <th>Document Link</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cases)): ?>
                    <?php foreach ($cases as $case): ?>
                        <tr>
                            <td><?php echo $case->id; ?></td>
                            <td><?php echo $case->judgment_date; ?></td>
                            <td><?php echo $case->case_number; ?></td>
                            <td><?php echo $case->name_of_parties; ?></td>
                            <td><?php echo $case->judgment_by; ?></td>
                            <td><a href="<?php echo $case->document_link; ?>" target="_blank">View Document</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No precedents found in the database.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
