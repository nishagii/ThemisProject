<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Knowledge - THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/juniorCounsel/knowledge.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>/* Edit knowledge page specific styles */
.current-image {
    margin: 15px 0;
    text-align: center;
}

.current-image p {
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

.current-image img {
    max-width: 100%;
    max-height: 200px;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
}

.image-preview p {
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

/* Form actions */
.form-actions {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 20px;
}

.form-actions button {
    background-color: #1d1b31;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    min-width: 150px;
}

.form-actions button:hover {
    background-color: #2c2a4a;
}

.cancel-btn {
    background-color: #f44336;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
    display: inline-block;
    text-align: center;
    min-width: 150px;
}

.cancel-btn:hover {
    background-color: #d32f2f;
}

/* Responsive adjustments for form actions */
@media (max-width: 768px) {
    .form-actions {
        flex-direction: column;
    }
    
    .form-actions button,
    .cancel-btn {
        width: 100%;
    }
    /* Header styling */
.add {
    font-size: 24px;
    font-weight: bold; /* This is already set to bold, but ensuring it's explicitly defined */
    color: #1d1b31;
    margin-bottom: 20px;
    text-align: center;
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
                <strong>Edit Knowledge Note</strong>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="error-container">
                    <?php foreach ($errors as $field => $error): ?>
                        <p><?= ucfirst($field) ?>: <?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="form-popup" id="formPopup">
                <form action="<?= ROOT ?>/Knowledge/updateKnowledge" method="POST" class="form-container" enctype="multipart/form-data">
                    <!-- Hidden field for knowledge ID -->
                    <input type="hidden" name="id" value="<?= htmlspecialchars($knowledge->id) ?>">

                    <div class="form-group">
                        <label for="topic">Topic:</label>
                        <input 
                            type="text" 
                            id="topic" 
                            name="topic" 
                            value="<?= htmlspecialchars($knowledge->topic) ?>" 
                            required>
                    </div>

                    <div class="form-group">
                        <label for="note">Note:</label>
                        <textarea 
                            id="note" 
                            name="note" 
                            rows="5" 
                            required><?= htmlspecialchars($knowledge->note) ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Image (Optional):</label>
                        <div class="file-input-container">
                            <input type="file" name="image" id="image" accept="image/*">
                            <label for="image">Choose File</label>
                            <span class="file-name">
                                <?= !empty($knowledge->image) ? basename($knowledge->image) : 'No file chosen' ?>
                            </span>
                        </div>
                        
                        <?php if (!empty($knowledge->image)): ?>
                            <div class="current-image">
                                <p>Current Image:</p>
                                <img src="<?= ROOT ?>/<?= $knowledge->image ?>" alt="Current Knowledge Image">
                            </div>
                        <?php endif; ?>
                        
                        <div class="image-preview" style="display: none;">
                            <p>New Image Preview:</p>
                            <img id="preview-image" src="#" alt="Preview">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="update" id="updateBtn">Update Knowledge</button>
                        <a href="<?= ROOT ?>/knowledge" class="cancel-btn">Cancel</a>
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
