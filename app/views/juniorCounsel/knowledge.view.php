
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/juniorCounsel/knowledge.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<?php include('component/bigNav.view.php'); ?>
<?php include('component/smallNav1.view.php'); ?>

    
   <a href="<?= ROOT ?>/addKnowledge"><button>Add Note</button></a>

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
                    <button onclick="editForm(<?= htmlspecialchars($knowledge->id) ?>, '<?= htmlspecialchars(addslashes($knowledge->topic)) ?>', '<?= htmlspecialchars(addslashes($knowledge->details)) ?>')">Edit</button>
                    <a href="<?= ROOT ?>/notes/deleteNote/<?= htmlspecialchars($knowledge->id) ?>" onclick="return confirm('Are you sure you want to delete this note?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</div>

    </div>
 
    

    
  


</body>
</html>