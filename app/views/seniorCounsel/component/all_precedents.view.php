<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Judgments Delivered</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Judgments Delivered in 2024</h1>
    <table border="1" style="width:100%; text-align:left;">
        <thead>
            <tr>
                <th>Date</th>
                <th>Case Number</th>
                <th>Name of Parties</th>
                <th>Judgment by</th>
                <th>Document</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($judgments)): ?>
                <?php foreach ($judgments as $judgment): ?>
                    <tr>
                        <td><?= htmlspecialchars($judgment->date); ?></td>
                        <td><?= htmlspecialchars($judgment->case_number); ?></td>
                        <td><?= htmlspecialchars($judgment->name_of_parties); ?></td>
                        <td><?= htmlspecialchars($judgment->judgment_by); ?></td>
                        <td><a href="documents/<?= htmlspecialchars($judgment->document_link); ?>"><?= htmlspecialchars($judgment->document_link); ?></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No judgments found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
