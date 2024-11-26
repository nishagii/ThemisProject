
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

    
    <div class="add-container">
            <div class="add">
                Pin down a knowledge note
            </div>

            <?php if (!empty($errors)): ?>
                    <div class="error-container">
                        <?php foreach ($errors as $field => $error): ?>
                            <p><?= ucfirst($field) ?>: <?= $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="form-popup" id="formPopup">
    <form action="<?= ROOT ?>/Knowledge/updateKnowledge" method="POST" class="form-container">
        <!-- Hidden field for knowledge ID -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($knowledge->id) ?>">

        <div class="form-group">
            <label for="topic">Topic:</label>
            <input 
                type="text" 
                id="topic" 
                name="topic" 
                value="<?= htmlspecialchars($knowledge->topic) ?>" 
                required>
        </div>

        <div class="form-group">
            <label for="note">Note:</label>
            <textarea 
                id="note" 
                name="note" 
                rows="5" 
                required><?= htmlspecialchars($knowledge->note) ?></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" name="update" id="updateBtn">Update Knowledge</button>
        </div>
    </form>
</div>


                </div>

               

    </div>
 
    

    
  


</body>
</html>