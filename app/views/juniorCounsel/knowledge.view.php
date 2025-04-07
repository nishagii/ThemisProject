<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/juniorCounsel/knowledge.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Imported for icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>

    <a href="<?= ROOT ?>/addKnowledge"><button class="add-note-btn">Add Note</button></a>



                <div class="note-container">
    <h1>Knowledge Notes</h1>
    <div class="notes-table-container">
    <table class="notes-table">
        <thead>
            <tr>
                <th>Topic</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($knowledge as $knowledge): ?>
            <tr>
                <td><?= htmlspecialchars($knowledge->topic) ?></td>
                <td><?= htmlspecialchars($knowledge->note) ?></td>
                                <td>
                    <a href="<?= ROOT ?>/knowledge/editKnowledge/<?= $knowledge->id ?>" title="Edit">
                        <i class='bx bx-edit' ></i>
                    </a>
                    <a href="<?= ROOT ?>/knowledge/deleteKnowledge/<?= htmlspecialchars($knowledge->id) ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this note?')">
                        <i class='bx bx-trash' ></i>
                    </a>
                </td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
