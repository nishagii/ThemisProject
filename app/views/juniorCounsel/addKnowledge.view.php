
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

                                <form action="<?= ROOT ?>/addKnowledge/add" method="POST" class="form-container">
                    <label for="topic">Topic:</label>
                    <input type="text" name="topic" id="topic" required>
                    <label for="note">Note:</label>
                    <textarea name="note" id="note" required></textarea>
                    <button type="submit" name="add" id="addBtn">Add</button>
                </form>

                </div>

               

    </div>
 
    

    
  


</body>
</html>