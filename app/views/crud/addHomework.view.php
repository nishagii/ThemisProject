<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT?>/assets/css/addHomework.css">
    <title>Document</title>
</head>
<body>
    <div class="form-container">
        <form method="POST" action="<?= ROOT?>/Homework/addHomework">
            <label for="subject">Subject Name:</label>
            <input type="text" id="subject" name="subject"> <br>
            <?php if(isset($errors['subject'])): ?>
                <p class="error"><?= htmlspecialchars($errors['subject']) ?></p>
            <?php endif; ?>


            <label for="desc">Home Description:</label>
            <textarea id="desc" name="desc"></textarea> <br>
            <?php if(isset($errors['desc'])): ?>
                <p class="error"> <?= htmlspecialchars($errors['desc']) ?> </p>
            <?php endif; ?>

            <label for="deadlineDate">Deadline Date:</label>
            <input type="date" name="deadlineDate" id="deadlineDate"> <br>
            <?php if(isset($errors['deadlineDate'])): ?>
                <p class="error"> <?= htmlspecialchars($errors['deadlineDate']) ?> </p>
            <?php endif; ?>

            <label for="deadlineTime">Deadline Time:</label>
            <input type="time" name="deadlineTime" id="deadlineTime"> <br>
            <?php if(isset($errors['deadlineTime'])): ?>
                <p class="error"> <?= htmlspecialchars($errors['deadlineTime']) ?> </p>
            <?php endif; ?>
            


            <label for="priority">Priority:</label>
            <select id="priority" name="priority">
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select> 
            <?php if(isset($errors['priority'])): ?>
                <p class="error"><?= htmlspecialchars($errors['priority']) ?> </p>
            <?php endif; ?> <br>
            <input type="submit" value="Add">
            <?php if(isset($errors['deadline'])): ?>
                <p class="error"><?= htmlspecialchars($errors['deadline']) ?> </p>
            <?php endif; ?>
        </form>
    </div>

    <script>
       document.addEventListener("DOMContentLoaded", () => {
            dateInput = document.getElementById('deadlineDate');
            today = new Date();
            todayDate = today.toISOString().split('T')[0];
            dateInput.setAttribute('min', todayDate);
       })
    </script>
</body>
</html>