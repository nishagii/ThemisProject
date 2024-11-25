<!-- yearwise_cases.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cases for Year <?php echo $year; ?></title>
</head>
<body>
    <h1>Cases for the year <?php echo $year; ?></h1>

    <!-- Year selection links -->
    <div>
        <?php
        $currentYear = date('Y');
        for ($i = $currentYear; $i >= 2000; $i--) {
            echo "<a href='?year=$i'>Cases from $i</a> | ";
        }
        ?>
    </div>

    <!-- Displaying cases in a table -->
    <table border="1">
        <thead>
            <tr>
                <th>Case Number</th>
                <th>Name of Parties</th>
                <th>Judgment By</th>
                <th>Document Link</th>
                <th>Judgment Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($cases)) { ?>
                <?php foreach ($cases as $case) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($case['case_number']); ?></td>
                        <td><?php echo htmlspecialchars($case['name_of_parties']); ?></td>
                        <td><?php echo htmlspecialchars($case['judgment_by']); ?></td>
                        <td><a href="<?php echo htmlspecialchars($case['document_link']); ?>" target="_blank">View Document</a></td>
                        <td><?php echo htmlspecialchars($case['judgment_date']); ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="5">No cases found for this year.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
