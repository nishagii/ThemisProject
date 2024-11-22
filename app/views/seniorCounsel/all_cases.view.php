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
    <title>Cases List</title>
</head>
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

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <h1>List of Cases</h1>

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