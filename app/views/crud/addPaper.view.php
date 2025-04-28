<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT?>/assets/css/addHomework.css">
    <title>Document</title>
</head>
<body>
    <div class="form-container">
    <form method="POST" action="<?= ROOT ?>/Paper/savePaper" enctype="multipart/form-data">
        <input type="text" name="subject"> <br> <br>
        <?php if(isset($errors['subject'])): ?>
            <p><?= htmlspecialchars($errors['subject'])?></p>
        <?php endif; ?>
        <input type="file" name="paper" accept="application/pdf">  <br> <br>
        <?php if(isset($errors['paper'])): ?>
            <p><?= htmlspecialchars($errors['paper'])?></p>
        <?php endif; ?>

        <input type="submit" value="add">
    </form>
    </div>
</body>
</html>