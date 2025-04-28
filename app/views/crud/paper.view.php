<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT?>/assets/css/addHomework.css">
    <title>Document</title>
</head>
<body>
    <div class="homework-container">
        <h1>Pastpapers List</h1>

        <a href="<?= ROOT?>/Paper/addPaper"><button>Add Pastpaper</button></a>

        
            <div class="homework">
                <?php if (!empty($paper)) : ?>
                    <?php foreach ($paper as $p) : ?>
                        <div class="homework-card">
                            <div class="label">Subject: <?= htmlspecialchars($p->subject) ?></div>
                            <div class="label">Paper: <a href="<?=ROOT?>/assets/paper/<?= htmlspecialchars($p->paper) ?>">Download</a></div>
                            
                            <div class="label">Created At: <?= htmlspecialchars($p->createdDate) ?></div>
                            <a href="<?= ROOT?>/Paper/deletePaper/<?= htmlspecialchars($p->paperID)?>">
                                <button>
                                    Delete
                                </button>
                            </a>
                            <!-- <a href="<?= ROOT?>/Homework/editHomework/<?= htmlspecialchars($hw->homeworkID)?>">
                                <button>
                                    Edit
                                </button>
                            </a> -->
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
