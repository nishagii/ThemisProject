<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT?>/assets/css/addHomework.css">
    <title>Document</title>
</head>
<body>
    <div class="form-container">
    <form method="POST" action="<?= ROOT ?>/Paper/updatePaper/<?= htmlspecialchars($paper[0]->paperID)?>" enctype="multipart/form-data">
        <input type="text" name="subject" value="<?= htmlspecialchars($paper[0]->subject)?>"> <br> <br>
        <?php if(isset($errors['subject'])): ?>
            <p><?= htmlspecialchars($errors['subject'])?></p>
        <?php endif; ?>
        <input type="file" name="paper" accept="application/pdf" > 
        <div class="form-group">
                <label>Existing File:</label>
            <p><?= htmlspecialchars($paper[0]->paper) ?></p>
        </div>
                     <br> <br>
        <?php if(isset($errors['paper'])): ?>
            <p><?= htmlspecialchars($errors['paper'])?></p>
        <?php endif; ?>

        <input type="submit" value="update">
    </form>

    <div class="flex">
                <div class="search-container">
                    <input type="text" id="document-search" placeholder="Search documents..." onkeyup="searchDocuments()">
                    
                </div>
                <div class="sort-section">
                    <label for="sort-options">Sort by:</label>
                    <select id="sort-options" onchange="sortDocuments()">
                        <option value="date-desc">Date (Newest)</option>
                        <option value="date-asc">Date (Oldest)</option>
                        <option value="name-asc">Name (A-Z)</option>
                        <option value="name-desc">Name (Z-A)</option>
                    </select>
                </div>

                <div class="filter-container">
                    <label for="filter-options">Filter:</label>
                    <select id="filter-options" onchange="filterDocuments()">
                        <option value="all">All Documents</option>
                        <option value="my-uploads">Uploaded by me</option>
                    </select>
                </div>
            </div>
    </div>
</body>
</html>