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
        <div class="cards-container">
            <?php foreach ($knowledge as $note): ?>
                <div class="card">
                    <div class="card-header"><?= htmlspecialchars($note->topic) ?></div>
                    <div class="card-content"><?= htmlspecialchars($note->note) ?></div>
                    <div class="card-actions">
                        <a href="<?= ROOT ?>/knowledge/editKnowledge/<?= $note->id ?>" class="btn btn-edit">Edit</a>
                        <a href="<?= ROOT ?>/knowledge/deleteKnowledge/<?= $note->id ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this note?')">Delete</a>
                    </div>
                    <a href="<?= ROOT ?>/addKnowledge">
    
</a>



                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>
</html>
