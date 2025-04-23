<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cs rules</title>
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/SCRules.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/spanbs/font-awesome/5.15.3/css/all.min.css">
    
    <!-- this is imported to use icons -->

</head>

<body>
    <!--Supreme court laws section starts from here-->
    <div class="rules-header">
        <h1>Supreme Court Rules</h1>
    </div>
    <div class="sc-rules">
    <?php if (!empty($rules)): ?>
                    <?php foreach ($rules as $rule): ?>
                        <ul>
                            <li>
                            <span><?php echo $rule->rule_number; ?></span>
                            <span><?php echo $rule->published_date; ?></span>
                            <span>
                                <span><a href="<?php echo $rule->sinhala_link; ?>" target="_blank">Sinhala</a></span>
                                <span><a href="<?php echo $rule->tamil_link; ?>" target="_blank">Tamil</a></span>
                                <span><a href="<?php echo $rule->english_link; ?>" target="_blank">English</a></span>
                                <span><a href="<?= ROOT ?>/SCrules/edit/<?= $rule->id ?>" class="btn btn-edit">Edit Rule</a></span>
                            </span>
                            </li>
                        </ul>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>
                       No rules found in the database.
                    </li>
                <?php endif; ?>
    </div>
</body>
</html>