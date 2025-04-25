<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Client Feedback - THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/all-feedback.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Add these specific styles to your CSS file or style tag */

        /* Override any hover effects for displayed ratings */
        .feedback-item .rating .fas.fa-star {
            color: #ddd; /* Default color for empty stars */
            cursor: default; /* Remove cursor pointer effect */
        }

        .feedback-item .rating .fas.fa-star.filled {
            color: #FFD700; /* Gold color for filled stars */
        }

        /* Important: Override any hover effects from other star rating CSS */
        .feedback-item .rating .fas.fa-star:hover,
        .feedback-item .rating .fas.fa-star:hover ~ .fas.fa-star {
            color: #ddd !important; /* Keep empty stars gray on hover */
        }

        .feedback-item .rating .fas.fa-star.filled:hover {
            color: #FFD700 !important; /* Keep filled stars gold on hover */
        }

        /* Make sure the feedback-header has proper spacing */
        .feedback-item .feedback-header {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        /* Make sure the stars have some spacing */
        .feedback-item .rating {
            font-size: 1.2rem;
            margin: 0.5rem 0;
        }

        .feedback-item .rating .fas.fa-star {
            margin-right: 0.2rem;
        }
    </style>
</head>
<body>

<?php include('component/bigNav.view.php'); ?>
<?php include('component/smallNav1.view.php'); ?>

<div class="feedback-container">
    <div class="feedback-header">
        <h2>All Client Feedback</h2>
    </div>

    <!-- Success/Error Messages -->
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="message error">
            <?= $_SESSION['error_message']; ?>
            <?php unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>

    <!-- Display all feedback - View Only -->
    <div class="feedback-list">
        <?php if (!empty($feedbacks)): ?>
            <?php foreach ($feedbacks as $feedback): ?>
                <div class="feedback-item">
                    <div class="feedback-header">
                        <div class="client-name">
                            <strong>Client:</strong> <?= htmlspecialchars($feedback->first_name . ' ' . $feedback->last_name) ?>
                        </div>
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
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-feedback">
                <p>No feedback has been submitted by clients yet.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
