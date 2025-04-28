<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT?>/assets/css/addHomework.css">
    <title>Document</title>
</head>
<body>
    <div class="form-container">
    <form method="POST" action="<?= ROOT ?>/savePaper" enctype="multipart/form-data">
        <input type="text" name="subject"> <br> <br>

        <input type="file" name="paper">  <br> <br>

        <input type="submit" value="add">
    </form>
    </div>
</body>
</html>