<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/task.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->

</head>
<body>


    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    
    <div class="parent-container">
        <div class="counters-container">
            <div class="counter total">
                <div class="counter-icon">
                    <i class="fas fa-tasks"></i> <!-- Updated icon -->
                </div>
                <strong>Total No of Tasks Assigned:</strong>
                <span class="total-users">200</span>
            </div>
            <div class="individual">
                <div class="counter">
                    <div class="counter-icon">
                        <i class="fas fa-spinner"></i> <!-- Icon for active tasks -->
                    </div>
                    <h3>Active Tasks</h3>
                    <span>50</span>
                </div>
                <div class="counter">
                    <div class="counter-icon">
                        <i class="fas fa-check-circle"></i> <!-- Icon for completed tasks -->
                    </div>
                    <h3>Completed Tasks</h3>
                    <span>25</span>
                </div>
                <div class="counter">
                    <div class="counter-icon">
                        <i class="fas fa-times-circle"></i> <!-- Icon for incomplete tasks -->
                    </div>
                    <h3>Incomplete Tasks</h3>
                    <span>25</span>
                </div>
            </div>
        </div>
    </div>


        <div class="add">
                <button class="add-button" >
                    <i class="bx bx-plus"></i> Assign New Task
                </button>
        </div>


</body>
</html>
