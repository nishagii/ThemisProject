
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/precedentsAdmin/all_precedents.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<?php include('component/bigNav.view.php'); ?>
<?php include('component/smallNav1.view.php'); ?>

<div class="header">
        <h1>All Precedents</h1>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Case Number</th>
                    <th>Name of Parties</th>
                    <th>Judgment By</th>
                    <th>Document Link</th>
                    <th>View More</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cases)): ?>
                    <?php foreach ($cases as $case): ?>
                        <tr>
                            <td><?php echo $case->judgment_date; ?></td>
                            <td><?php echo $case->case_number; ?></td>
                            <td><?php echo $case->name_of_parties; ?></td>
                            <td><?php echo $case->judgment_by; ?></td>
                            <td><a href="<?php echo $case->document_link; ?>" target="_blank">View Document</a></td>
                            <td>
                                <a href="<?= ROOT ?>/PrecedentsController/retrieveOneViewOnly/<?= $case->id; ?>">
                                <button class="more">View more</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No precedents found in the database.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


</body>
</html>