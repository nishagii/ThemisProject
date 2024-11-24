<!-- this was used to debug if the cases data are being fetched from the database to the view
issue was in the core controller view function -->
<!-- <?php
// Debug the cases variable
var_dump(isset($cases) ? $cases : 'Cases variable not set');
?> -->

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>THEMIS</title>
    
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/case.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <h1>List of Cases</h1>
<div class="button">
    <a href="#">
        <button class="add">Tabular View</button>
    </a>
</div>
            <div class="cases-container">
                <?php if (!empty($cases)) : ?>
                    <?php foreach ($cases as $case) : ?>
                        <div class="case-card">
            <h3>Case Number: <?= htmlspecialchars($case->case_number) ?></h3>
            <p><strong>Client Name:</strong> <?= htmlspecialchars($case->client_name) ?></p>
            <p><strong>Court:</strong> <?= htmlspecialchars($case->court) ?></p>
            <p><strong>Notes:</strong> <?= htmlspecialchars($case->notes) ?></p>

            <div class="button">

            <a href="<?= ROOT ?>/cases/retrieveCase/<?= $case->id; ?>">
                <button class="more">More details</button>
            </a>
            </div>
        </div>

            <?php endforeach; ?>
        <?php else : ?>
            <p>No cases found.</p>
        <?php endif; ?>
    </div>
</body>
</html>