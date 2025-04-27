<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Knowledge - THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/juniorCounsel/knowledge.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<<style>
    /* Main layout */
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

/* Add container styling */
.add-container {
    width: 80%;
    max-width: 800px;
    margin: 30px auto;
    padding: 25px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Header styling */
.add {
    font-size: 24px;
    font-weight: bold;
    color: #1d1b31;
    margin-bottom: 20px;
    text-align: center;
}

/* Error container */
.error-container {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 4px;
    border: 1px solid #f5c6cb;
}

/* Form popup */
.form-popup {
    display: block;
    width: 100%;
}

/* Form container */
.form-container {
    display: flex;
    flex-direction: column;
    width: 100%;
}

/* Form groups */
.form-group {
    margin-bottom: 20px;
}

/* Form labels */
.form-container label,
.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

/* Form inputs */
.form-container input[type="text"],
.form-container textarea,
.form-group input[type="text"],
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.form-container textarea,
.form-group textarea {
    min-height: 150px;
    resize: vertical;
}

/* File input styling */
.file-input-container {
    margin-bottom: 10px;
}

.file-input-container input[type="file"] {
    display: none;
}

.file-input-container label {
    display: inline-block;
    background-color: #1d1b31;
    color: white;
    padding: 8px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
}

.file-input-container label:hover {
    background-color: #2c2a4a;
}

.file-name {
    margin-left: 10px;
    font-size: 14px;
    color: #666;
}

/* Image preview */
.image-preview {
    margin-top: 10px;
    text-align: center;
    display: none;
}

.image-preview img {
    max-width: 100%;
    max-height: 200px;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
}

/* Form buttons */
.form-buttons {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.form-buttons button {
    background-color: #1d1b31;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    min-width: 150px;
}

.form-buttons button:hover {
    background-color: #2c2a4a;
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
    
    .add-container {
        width: 95%;
        padding: 15px;
    }
    
    .form-buttons button {
        width: 100%;
    }
}
</style>
<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    
    <div class="home-section">
        <div class="add-container">
            <div class="add">
                Pin down a knowledge note
            </div>
            
            <?php if (!empty($errors)): ?>
                <div class="error-container">
                    <?php foreach ($errors as $field => $error): ?>
                        <p><?= ucfirst($field) ?>: <?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <div class="form-popup" id="formPopup">
                <form action="<?= ROOT ?>/addKnowledge/add" method="POST" class="form-container" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="topic">Topic:</label>
                        <input type="text" name="topic" id="topic" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="note">Note:</label>
                        <textarea name="note" id="note" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Image (Optional):</label>
                        <div class="file-input-container">
                            <input type="file" name="image" id="image" accept="image/*">
                            <label for="image">Choose File</label>
                            <span class="file-name">No file chosen</span>
                        </div>
                        <div class="image-preview">
                            <img id="preview-image" src="#" alt="Preview">
                        </div>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="submit" name="add" id="addBtn">Add Knowledge</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Script to show file name and preview image
        document.getElementById('image').addEventListener('change', function(e) {
            // Show file name
            const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
            document.querySelector('.file-name').textContent = fileName;
            
            // Show image preview
            if (e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                    document.querySelector('.image-preview').style.display = 'block';
                }
                reader.readAsDataURL(e.target.files[0]);
            } else {
                document.querySelector('.image-preview').style.display = 'none';
            }
        });
    </script>
</body>
</html>
