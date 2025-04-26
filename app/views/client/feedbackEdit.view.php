<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Feedback - THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/client/feedback.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    /* Feedback CSS */
.feedback-container {
    width: 80%;
    margin: 2rem auto;
    padding: 2rem;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.feedback-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e0e0e0;
}

.feedback-header h2 {
    margin: 0;
    color: #333;
    font-size: 1.8rem;
}

.add-feedback-btn {
    background-color: #1e88e5;
    color: white;
    border: none;
    padding: 0.7rem 1.2rem;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s;
}

.add-feedback-btn:hover {
    background-color: #1565c0;
}

.back-btn {
    background-color: #757575;
    color: white;
    text-decoration: none;
    padding: 0.7rem 1.2rem;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s;
}

.back-btn:hover {
    background-color: #616161;
}

/* Message styles */
.message {
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 4px;
}

.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Error container */
.error-container {
    background-color: #f8d7da;
    color: #721c24;
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 4px;
    border: 1px solid #f5c6cb;
}

/* Form popup */
.form-popup {
    display: none;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    overflow: auto;
}

.form-container {
    position: relative;
    background-color: #fff;
    margin: 10% auto;
    padding: 2rem;
    border-radius: 8px;
    width: 60%;
    max-width: 600px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.form-container h3 {
    margin-top: 0;
    color: #333;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-container label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: bold;
    color: #555;
}

.star-rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
    margin-bottom: 1.5rem;
}

.star-rating input {
    display: none;
}

.star-rating label {
    cursor: pointer;
    font-size: 1.8rem;
    color: #ddd;
    margin-right: 0.5rem;
}

.star-rating label:hover,
.star-rating label:hover ~ label,
.star-rating input:checked ~ label {
    color: #ffb400;
}

.star-rating .filled {
    color: #ffb400;
}

.form-container textarea {
    width: 100%;
    padding: 0.8rem;
    margin-bottom: 1.5rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    resize: vertical;
    min-height: 120px;
    font-family: inherit;
    font-size: 1rem;
}

.form-buttons {
    display: flex;
    justify-content: space-between;
}

.submit-btn {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 0.7rem 1.2rem;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s;
}

.submit-btn:hover {
    background-color: #43a047;
}

.cancel-btn {
    background-color: #f44336;
    color: white;
    border: none;
    padding: 0.7rem 1.2rem;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s;
    text-decoration: none;
    display: inline-block;
}

.cancel-btn:hover {
    background-color: #e53935;
}

/* Feedback list */
.feedback-list {
    margin-top: 2rem;
}

.feedback-item {
    background-color: #f9f9f9;
    border-radius: 6px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s;
}

.feedback-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.feedback-item .feedback-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #eee;
}

.feedback-item .rating {
    font-size: 1.2rem;
}

.feedback-item .feedback-date {
    color: #757575;
    font-size: 0.9rem;
}

.feedback-item .feedback-body {
    margin-bottom: 1rem;
    line-height: 1.5;
    color: #333;
}

.feedback-item .feedback-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}

.edit-btn, .delete-btn {
    padding: 0.5rem 1rem;
    border-radius: 4px;
    text-decoration: none;
    font-size: 0.9rem;
    transition: background-color 0.3s;
}

.edit-btn {
    background-color: #2196f3;
    color: white;
}

.edit-btn:hover {
    background-color: #1976d2;
}

.delete-btn {
    background-color: #f44336;
    color: white;
}

.delete-btn:hover {
    background-color: #e53935;
}

.no-feedback {
    text-align: center;
    padding: 2rem;
    color: #757575;
}

/* Edit Form */
.edit-form {
    background-color: #f9f9f9;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Client name in all-feedback view */
.client-name {
    font-size: 1.1rem;
    color: #333;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .feedback-container {
        width: 95%;
        padding: 1rem;
    }
    
    .form-container {
        width: 90%;
        padding: 1.5rem;
    }
    
    .feedback-item .feedback-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .feedback-item .rating {
        margin-bottom: 0.5rem;
    }
    
    .form-buttons {
        flex-direction: column;
        gap: 1rem;
    }
    
    .submit-btn, .cancel-btn {
        width: 100%;
    }
}
</style>
<body>

<?php include('component/bigNav.view.php'); ?>
<?php include('component/smallNav1.view.php'); ?>

<div class="feedback-container">
    <div class="feedback-header">
        <h2>Edit Feedback</h2>
        <a href="<?= ROOT ?>/feedback" class="back-btn">Back to Feedback</a>
    </div>

    <!-- Error messages from validation -->
    <?php if (!empty($errors)): ?>
        <div class="error-container">
            <?php foreach ($errors as $field => $error): ?>
                <p><?= ucfirst($field) ?>: <?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Edit Feedback Form -->
    <div class="edit-form">
        <form action="<?= ROOT ?>/feedback/edit/<?= $feedback->id ?>" method="POST" class="form-container">
            <label for="rating">Rating:</label>
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5" <?= $feedback->rating == 5 ? 'checked' : '' ?>>
                <label for="star5"><i class="fas fa-star"></i></label>
                
                <input type="radio" id="star4" name="rating" value="4" <?= $feedback->rating == 4 ? 'checked' : '' ?>>
                <label for="star4"><i class="fas fa-star"></i></label>
                
                <input type="radio" id="star3" name="rating" value="3" <?= $feedback->rating == 3 ? 'checked' : '' ?>>
                <label for="star3"><i class="fas fa-star"></i></label>
                
                <input type="radio" id="star2" name="rating" value="2" <?= $feedback->rating == 2 ? 'checked' : '' ?>>
                <label for="star2"><i class="fas fa-star"></i></label>
                
                <input type="radio" id="star1" name="rating" value="1" <?= $feedback->rating == 1 ? 'checked' : '' ?>>
                <label for="star1"><i class="fas fa-star"></i></label>
            </div>
            
            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?= htmlspecialchars($feedback->description) ?></textarea>
            
            <div class="form-buttons">
                <button type="submit" class="submit-btn">Update Feedback</button>
                <a href="<?= ROOT ?>/feedback" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
