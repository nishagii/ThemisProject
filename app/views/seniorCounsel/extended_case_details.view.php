<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cases List</title>
    <style>
        /* Add your styling here */
    </style>
</head>

<body>
    <h1>List of Cases</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Client Name</th>
                <th>Case Number</th>
                <th>Court</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($cases)) : ?>
                <?php foreach ($cases as $index => $case) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($case->client_name) ?></td>
                        <td><?= htmlspecialchars($case->case_number) ?></td>
                        <td><?= htmlspecialchars($case->court) ?></td>
                        <td><?= htmlspecialchars($case->notes) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">No cases found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>