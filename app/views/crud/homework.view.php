<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT?>/assets/css/addHomework.css">
    <title>Document</title>
</head>
<body>
    <div class="homework-container">
        <h1>Homeworks List</h1>

        <a href="<?= ROOT?>/Homework/homeworkForm"><button>Add Homework</button></a>

        
            <div class="homework">
                <?php if (!empty($homework)) : ?>
                    <?php foreach ($homework as $hw) : ?>
                        <div class="homework-card">
                            <div class="label">Subject: <?= htmlspecialchars($hw->subject) ?></div>
                            <div class="label">Description: <?= htmlspecialchars($hw->desc) ?></div>
                            <div class="label">Due Date: <span class="due"><?= htmlspecialchars($hw->deadlineDate) ?></span></div>
                            <div class="label">Due Time: <?= htmlspecialchars($hw->deadlineTime) ?></div>
                            <div class="label">Priority: <?= htmlspecialchars($hw->priority) ?></div>
                            <div class="label">Created At: <?= htmlspecialchars($hw->createdDate) ?></div>
                            <a href="<?= ROOT?>/Homework/deleteHw/<?= htmlspecialchars($hw->homeworkID)?>">
                                <button>
                                    Delete
                                </button>
                            </a>
                            <a href="<?= ROOT?>/Homework/editHomework/<?= htmlspecialchars($hw->homeworkID)?>">
                                <button>
                                    Edit
                                </button>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No homework found.</p>
                <?php endif; ?>
            </div>
            
       
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Your JS logic if needed
        });
    </script>
</body>
</html>
