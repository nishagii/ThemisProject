
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/juniorCounsel/knowledge.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<?php include('component/bigNav.view.php'); ?>
<?php include('component/smallNav1.view.php'); ?>

<div class="search-container">
        <input type="text" placeholder="Search" class="search-bar" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'"  /> 
    </div>
    <div class="add-container">
    <div class="add-container">
            <div class="add">
                Pin down a knowledge note
                <i class="fas fa-thumbtack" style="font-size: 30px; margin-left: 5px; color: #000;"></i> <!-- Replaced with Font Awesome icon -->
                <button>Add note</button>
            </div>
        </div>

    </div>
    <div class="notes-container">
        <table class="notes-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Topic</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2024-11-17</td>
                    <td>Contract Law Basics</td>
                    <td>Key principles include offer, acceptance, consideration, and intention to create legal relations.</td>
                </tr>
                <tr>
                    <td>2024-11-16</td>
                    <td>Case Study: Donoghue v. Stevenson</td>
                    <td>This case established the modern law of negligence.</td>
                </tr>
            </tbody>
        </table>
    </div>


</body>
</html>