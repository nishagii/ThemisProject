<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knowledge Management - THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/juniorCounsel/knowledge.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    /* Knowledge page styling */
.home-section {
    position: relative;
    background: #f5f5f5;
    min-height: 100vh;
    width: calc(100% - 78px);
    left: 78px;
    transition: all 0.5s ease;
    padding: 20px;
}

.sidebar.open ~ .home-section {
    left: 250px;
    width: calc(100% - 250px);
}

/* Knowledge header */
.knowledge-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding: 10px 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.knowledge-header h1 {
    color: #1d1b31;
    margin: 0;
    font-size: 24px;
}

.add-note-btn {
    background-color: #1d1b31;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    text-decoration: none;
    display: inline-block;
    transition: background-color 0.3s;
}

.add-note-btn:hover {
    background-color: #2c2a4a;
}

/* Notes container */
.notes-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 0 auto;
    max-width: 1200px;
}

/* Table styling */
.notes-table-container {
    overflow-x: auto;
    width: 100%;
}

.notes-table {
    width: 100%;
    border-collapse: collapse;
}

.notes-table th,
.notes-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

.notes-table th {
    background-color: #f8f9fa;
    color: #333;
    font-weight: bold;
}

.notes-table tr:hover {
    background-color: #f5f5f5;
}

/* Image cell */
.image-cell {
    width: 120px;
    text-align: center;
}

.image-cell img {
    width: 100px;
    height: auto;
    border-radius: 4px;
    object-fit: cover;
}

.no-image {
    color: #999;
    font-style: italic;
}

/* Actions cell */
.actions-cell {
    width: 100px;
    text-align: center;
}

.edit-btn, .delete-btn {
    display: inline-block;
    padding: 5px;
    margin: 0 3px;
    color: #1d1b31;
    font-size: 18px;
    transition: color 0.3s;
}

.edit-btn:hover {
    color: #4caf50;
}

.delete-btn:hover {
    color: #f44336;
}

/* No records message */
.no-records {
    text-align: center;
    padding: 20px;
    color: #666;
    font-style: italic;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .home-section {
        width: 100%;
        left: 0;
    }
    
    .sidebar.open ~ .home-section {
        left: 250px;
        width: calc(100% - 250px);
    }
    
    .knowledge-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .add-note-btn {
        align-self: flex-end;
    }
    
    .notes-table th,
    .notes-table td {
        padding: 8px 10px;
    }
    
    .image-cell {
        width: 80px;
    }
    
    .image-cell img {
        width: 70px;
    }
}
/* Add Note button styling */
.add-note-btn {
    background-color: #1d1b31;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: background-color 0.3s;
}

.add-note-btn i {
    font-size: 18px;
}

.add-note-btn:hover {
    background-color: #2c2a4a;
}

.add-container {
    margin: 20px auto;
    max-width: 800px; 
    padding: 20px;
    background-color: #eaf1fd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
}
.add-container {
    margin: 20px;
    padding: 20px;
    background-color: #eaf1fd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
}

.add {
    font-size: 18px;
    color: #011517;  
    cursor: pointer;
    display: flex;
    align-items: center;
}

.add i {
    margin-left: 5px;
    color: #00bcd4; 
}

.form-popup {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 0 auto; /* Center the form */
    width: 100%; /* Use full width of parent */

}
/* Center the form elements */
.form-container {
    display: flex;
    flex-direction: column;
    align-items: center; /* Center form elements horizontally */
    width: 100%;
}

.form-container label {
    display: block;
    margin-bottom: 10px;
    font-size: 14px;
    color: #021a1d;  
}

.form-container input,
.form-container textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #deeaec;
    border-radius: 4px;
    font-size: 14px;
    background-color: #f6faff; 
    color: rgb(13, 9, 9);
}

.form-container button {
    background-color: #1d1b31;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.form-container button:hover {
    background-color: #555276;
}

.note-container {
    margin: 20px;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

 
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background-color: #fff;
}

th, td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #11101b;
    color: white;
    font-size: 16px;
}

td {
    font-size: 14px;
    color: #555;
}




@media (max-width: 768px) {
    th, td {
        padding: 10px;
    }

    h1 {
        font-size: 20px;
    }
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
}


a > button {
    background-color: #0a2f56;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin: 20px;
    text-transform: uppercase;
    transition: background-color 0.3s ease;
}

a > button:hover {
    background-color: #064e9a;
}


.note-container {
    width: 90%;
    margin: 0 auto;
    padding: 20px;
    background: #fff;
    box-shadow: 0 4px 8px rgba(39, 7, 145, 0.1);
    border-radius: 8px;
}

.note-container h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #444;
}

.notes-table-container {
    overflow-x: auto;
}

.notes-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: #fafafa;
}

.notes-table th,
.notes-table td {
    padding: 10px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.notes-table th {
    background: #02203f;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
}

.notes-table tr:hover {
    background-color: #f1f1f1;
}

 
.notes-table td i {
    font-size: 20px;
    margin: 0 10px;
    cursor: pointer;
    transition: color 0.3s ease;
    color: #3807b2;
}
.notes-table td i.bx-trash {
    color: #b71417;}

.notes-table td i:hover {
    color: #0ebb4d;
}


.notes-table td i.bx-trash:hover {
    color: #e58518;
}


</style>
<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    
    <div class="home-section">
        <div class="knowledge-header">
            <h1>Knowledge Notes</h1>
            <button class="add-note-btn" onclick="window.location.href='<?= ROOT ?>/addKnowledge'">
                <i class='bx bx-plus'></i> Add Note
            </button>
        </div>

    

        <div class="notes-container">
            <div class="notes-table-container">
                <table class="notes-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Topic</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($knowledge)): ?>
                            <?php foreach ($knowledge as $knowledge): ?>
                                <tr>
                                    <td class="image-cell">
                                        <?php if (!empty($knowledge->image)): ?>
                                            <img src="<?= ROOT ?>/<?= $knowledge->image ?>" alt="Knowledge Image">
                                        <?php else: ?>
                                            <span class="no-image">No Image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($knowledge->topic) ?></td>
                                    <td><?= htmlspecialchars($knowledge->note) ?></td>
                                    <td class="actions-cell">
                                        <a href="<?= ROOT ?>/knowledge/editKnowledge/<?= $knowledge->id ?>" title="Edit" class="edit-btn">
                                            <i class='bx bx-edit'></i>
                                        </a>
                                        <a href="<?= ROOT ?>/knowledge/deleteKnowledge/<?= htmlspecialchars($knowledge->id) ?>" title="Delete" class="delete-btn" onclick="return confirm('Are you sure you want to delete this note?')">
                                            <i class='bx bx-trash'></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="no-records">No knowledge notes found. Click "Add Note" to create one.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
