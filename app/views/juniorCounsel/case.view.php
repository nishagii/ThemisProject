
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <style>
    .cases-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 20px;
        justify-content: center;
        background-color: #f9f9f9;
        /* flex-direction: column; */
    }

    .case-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        max-width: 300px;
        text-align: left;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .case-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .case-card h3 {
        font-size: 1.2em;
        color: #333;
        margin-bottom: 10px;
    }

    .case-card p {
        margin: 5px 0;
        color: #666;
        font-size: 0.9em;
    }

    .case-card strong {
        color: #444;
    }
</style>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<?php include('component/bigNav.view.php'); ?>
<?php include('component/smallNav1.view.php'); ?>

<a href="<?= ROOT ?>/cases/extendRetrieveAllCases">
        <button>Tabular View</button>
    </a>

    <div class="cases-container">
        <?php if (!empty($cases)) : ?>
            <?php foreach ($cases as $case) : ?>
                <div class="case-card">
                    <h3>Case Number: <?= htmlspecialchars($case->case_number) ?></h3>
                    <p><strong>Client Name:</strong> <?= htmlspecialchars($case->client_name) ?></p>
                    <p><strong>Court:</strong> <?= htmlspecialchars($case->court) ?></p>
                    <p><strong>Notes:</strong> <?= htmlspecialchars($case->notes) ?></p>

                    <a href="<?= ROOT ?>/cases/retrieveCase/<?= $case->id; ?>">
                        <button>More details</button>
                    </a>

                    <a href="<?= ROOT ?>/cases/editCase/<?= $case->id; ?>">
                        <button>Edit</button>
                    </a>

                    <a href="<?= ROOT ?>/cases/deleteCase/<?= $case->id; ?>">
                        <button>Delete</button>
                    </a>

                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No cases found.</p>
        <?php endif; ?>
    </div>


</body>
</html>