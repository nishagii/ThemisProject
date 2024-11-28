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
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/case.css">

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <div class="allcases-section">
        <h1>List of All Cases</h1>
    </div>
    <div class="paragraph-all-cases">
        Click here to add a
        <span style="color: #fa9800; font-weight: bold;">new case</span> or to view details in
        <span style="color: #fa9800; font-weight: bold;">tabular view</span>.
    </div>

    <div class="button">
        <a href="<?= ROOT ?>/cases">
            <button class="add">Add New Case</button>
        </a>
        <a href="<?= ROOT ?>/cases/extendRetrieveAllCases">
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

                        <a href="<?= ROOT ?>/cases/editCase/<?= $case->id; ?>">
                            <button class="edit">
                                <i class="bx bx-edit"></i> <!-- Boxicon for Edit -->
                            </button>
                        </a>

                        <a href="<?= ROOT ?>/cases/deleteCase/<?= $case->id; ?>">
                            <button class="delete">
                                <i class="bx bx-trash"></i> <!-- Boxicon for Delete -->
                            </button>
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