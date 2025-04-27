<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cs rules</title>
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/SCRules.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/spanbs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- this is imported to use icons -->

</head>

<body>
<?php include('component/bigNav.view.php'); ?>
<?php include('component/smallNav1.view.php'); ?>
<?php include('component/sidebar.view.php'); ?>
<div class="home-section">
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
</div>
    <script>
        function confirmDelete(ruleId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this rule? This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#93a8e3',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                background: '#fafafa',
                color: '#1d1b31',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the delete action
                    window.location.href = `<?= ROOT ?>/SCrules/delete/${ruleId}`;
                }
            });
        }
    </script>
</body>
</html>