<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Feedback - THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/public/assets/css/client/feedbackcss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

</head>
<style>
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
    display: flex;
    align-items: center;
}

.add-feedback-btn i {
    margin-right: 8px;
}

.add-feedback-btn:hover {
    background-color: #1565c0;
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
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

.feedback-item {
    background-color: #f9f9f9;
    border-radius: 6px;
    padding: 1.5rem;
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
/* Add this to your CSS */
.feedback-item .rating .filled {
    color: #ffb400;
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
    grid-column: 1 / -1;

}
.feedback-item .rating .filled {
    color: #FFD700 !important; /* Bright gold color with !important to override any other styles */
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
    
    .feedback-list {
        grid-template-columns: 1fr;
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

</style>
<body>

<?php include('component/bigNav.view.php'); ?>
<?php include('component/smallNav1.view.php'); ?>
<?php include(__DIR__ . '/../seniorCounsel/component/sidebar.view.php'); ?>




<div class="feedback-container">
    <div class="feedback-header">
        <h2>My Feedback</h2>
        <button class="add-feedback-btn" onclick="openFeedbackForm()">
            <i class="fas fa-plus"></i> Add New Feedback
        </button>
    </div>

    <!-- Success/Error Messages -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="message success">
            <i class="fas fa-check-circle"></i> <?= $_SESSION['success_message']; ?>
            <?php unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="message error">
            <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error_message']; ?>
            <?php unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>

    <!-- Error messages from validation -->
    <?php if (!empty($errors)): ?>
        <div class="error-container">
            <?php foreach ($errors as $field => $error): ?>
                <p><i class="fas fa-exclamation-triangle"></i> <?= ucfirst($field) ?>: <?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Add Feedback Form Popup -->
    <div class="form-popup" id="feedbackFormPopup">
        <form action="<?= ROOT ?>/feedback/add" method="POST" class="form-container">
            <h3>Add Your Feedback</h3>
            
            <label for="rating">Rating:</label>
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5" <?= isset($data['rating']) && $data['rating'] == 5 ? 'checked' : '' ?>>
                <label for="star5"><i class="fas fa-star"></i></label>
                
                <input type="radio" id="star4" name="rating" value="4" <?= isset($data['rating']) && $data['rating'] == 4 ? 'checked' : '' ?>>
                <label for="star4"><i class="fas fa-star"></i></label>
                
                <input type="radio" id="star3" name="rating" value="3" <?= isset($data['rating']) && $data['rating'] == 3 ? 'checked' : '' ?>>
                <label for="star3"><i class="fas fa-star"></i></label>
                
                <input type="radio" id="star2" name="rating" value="2" <?= isset($data['rating']) && $data['rating'] == 2 ? 'checked' : '' ?>>
                <label for="star2"><i class="fas fa-star"></i></label>
                
                <input type="radio" id="star1" name="rating" value="1" <?= isset($data['rating']) && $data['rating'] == 1 ? 'checked' : '' ?>>
                <label for="star1"><i class="fas fa-star"></i></label>
            </div>
            
            <label for="description">Description:</label>
            <textarea name="description" id="description" placeholder="Please share your experience..." required><?= isset($data['description']) ? htmlspecialchars($data['description']) : '' ?></textarea>
            
            <div class="form-buttons">
                <button type="submit" class="submit-btn">Submit Feedback</button>
                <button type="button" class="cancel-btn" onclick="closeFeedbackForm()">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Display existing feedback -->
    <!-- Replace the existing feedback-item display code in your HTML -->
<div class="feedback-list">
    <?php if (!empty($feedbacks)): ?>
        <?php foreach ($feedbacks as $feedback): ?>
            <div class="feedback-item">
                <div class="feedback-header">
                    <div class="rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <?php if ($i <= $feedback->rating): ?>
                                <i class="fas fa-star filled"></i>
                            <?php else: ?>
                                <i class="fas fa-star"></i>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <div class="feedback-date">
                        <?= date('F j, Y', strtotime($feedback->created_at)) ?>
                    </div>
                </div>
                <div class="feedback-body">
                    <p><?= htmlspecialchars($feedback->description) ?></p>
                </div>
                <div class="feedback-actions">
                    <a href="<?= ROOT ?>/feedback/edit/<?= $feedback->id ?>" class="edit-btn">Edit</a>
                    <a href="<?= ROOT ?>/feedback/delete/<?= $feedback->id ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this feedback?')">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-feedback">
            <p>You haven't provided any feedback yet. Click "Add New Feedback" to get started.</p>
        </div>
    <?php endif; ?>
</div>

<script>
    // Function to open the feedback form popup
    function openFeedbackForm() {
        document.getElementById("feedbackFormPopup").style.display = "block";
    }

    // Function to close the feedback form popup
    function closeFeedbackForm() {
        document.getElementById("feedbackFormPopup").style.display = "none";
    }

    // Close the popup when clicking outside of it
    window.onclick = function(event) {
        let popup = document.getElementById("feedbackFormPopup");
        if (event.target == popup) {
            popup.style.display = "none";
        }
    }
</script>

</body>
</html>
