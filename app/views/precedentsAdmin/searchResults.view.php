<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Precedents</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/precedentsAdmin/all_precedents.css">
</head>
<body>
    <?php if (!empty($cases)): ?>
        <?php foreach ($cases as $case): ?>
            <tr>
                <td><?= $case->judgment_date; ?></td>
                <td><?= $case->case_number; ?></td>
                <td><?= $case->description; ?></td>
                <td><?= $case->judgment_by; ?></td>
                <td><a href="<?= $case->document_link; ?>" target="_blank">View Document</a></td>
                <td>
                    <a href="<?= ROOT ?>/PrecedentsController/retrieveOne/<?= $case->id; ?>">
                        <button class="more">View more</button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="6">No results found for your search.</td></tr>
    <?php endif; ?>
</body>    