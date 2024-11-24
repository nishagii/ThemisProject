<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precedents</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/precedent.css">
</head>
<body>
    <div class="header">
        <h1>Judgments Delivered in 2024</h1>
        <a href="<?= ROOT ?>/precedents/create" class="btn-add">Add New Precedent</a>
    </div>

    <div class="precedent-table">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Case Number</th>
                    <th>Name of Parties</th>
                    <th>Judgment by</th>
                    <th>Document</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($precedents) && is_array($precedents)): ?>
                    <?php foreach($precedents as $precedent): ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($precedent->date)) ?></td>
                            <td><?= htmlspecialchars($precedent->case_number) ?></td>
                            <td><?= htmlspecialchars($precedent->parties) ?></td>
                            <td><?= htmlspecialchars($precedent->judgment_by) ?></td>
                            <td><a href="<?= htmlspecialchars($precedent->document_link) ?>" class="doc-link">doc</a></td>
                            <td class="actions">
                                <a href="<?= ROOT ?>/precedents/edit/<?= $precedent->id ?>" class="btn-edit">Edit</a>
                                <a href="<?= ROOT ?>/precedents/delete/<?= $precedent->id ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this precedent?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>