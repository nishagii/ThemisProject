<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($blog->title) ?> - Blog Details</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/blog.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">

</head>
<body>

<?php include('component/bigNav.view.php'); ?>
<?php include('component/smallNav1.view.php'); ?>
<?php include('component/sidebar.view.php'); ?>

<div class="home-section">
    <div class="blog-detail-container">
        <a class="back-btn" href="<?= ROOT ?>/blog/viewBlog"><i class="bx bx-arrow-back"></i></a>
        <div class="blog">
        <h1 class="blog-detail-title"><?= htmlspecialchars($blog->title) ?></h1>
        <p class="blog-detail-meta">
            By <?= htmlspecialchars($blog->author) ?> |
            <?= date('F j, Y', strtotime($blog->created_at)) ?>
        </p>

        <?php if ($blog->image_url): ?>
            <img class="blog-detail-image" src="<?= ROOT ?>/assets/blog_images/<?= htmlspecialchars($blog->image_url) ?>" alt="Blog Image">
        <?php endif; ?>

        <div class="blog-detail-content">
            <?= nl2br(htmlspecialchars($blog->content)) ?>
        </div>

        <div class="blog-detail-actions">
            <a href="<?= ROOT ?>/blog/edit/<?= $blog->id ?>" class="edit-btn"><i class="bx bx-edit"></i> Edit</a>
            <a href="<?= ROOT ?>/blog/delete/<?= $blog->id ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this blog post?');">
                <i class="bx bx-trash"></i> Delete
            </a>
        </div>

        
        </div>
    </div>
</div>

</body>
</html>
