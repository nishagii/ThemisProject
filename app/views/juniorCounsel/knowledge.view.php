
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

    
   <a href="<?= ROOT ?>/addKnowledge"><button>Add Note</button></a>

                <div class="note-container">
    <h1>Knowledge Notes</h1>
    <table>
        <thead>
            <tr>
                <th>Topic</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Topic A</td>
                <td>This is the note for Topic A. It provides detailed information.</td>
                <td>
                    <button onclick="editForm(1, 'Topic A', 'This is the note for Topic A. It provides detailed information.')">Edit</button>
                    <a href="#" onclick="return confirm('Are you sure you want to delete this note?')">Delete</a>
                </td>
            </tr>
            <tr>
                <td>Topic B</td>
                <td>Note for Topic B with some interesting insights and ideas.</td>
                <td>
                    <button onclick="editForm(2, 'Topic B', 'Note for Topic B with some interesting insights and ideas.')">Edit</button>
                    <a href="#" onclick="return confirm('Are you sure you want to delete this note?')">Delete</a>
                </td>
            </tr>
            <tr>
                <td>Topic C</td>
                <td>Topic C covers a wide range of useful information, summarizing key points.</td>
                <td>
                    <button onclick="editForm(3, 'Topic C', 'Topic C covers a wide range of useful information, summarizing key points.')">Edit</button>
                    <a href="#" onclick="return confirm('Are you sure you want to delete this note?')">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

    </div>
 
    

    
  


</body>
</html>