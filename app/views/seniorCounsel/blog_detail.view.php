<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($blog->title) ?> - Blog Details</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/blog.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <style>
        .blog-detail-container {
           
            padding: 20px;
            
        }

        .blog {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .blog-detail-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .blog-detail-meta {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 20px;
        }

        .blog-detail-image {
            width: 50%;
           
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .blog-detail-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #444;
        }

        .back-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #40468b;
            color: #fff;
            text-decoration: none;
            border-radius: 20px;
            transition: background-color 0.3s;
        }

        .back-btn:hover {
            background-color:rgb(45, 51, 112);
        }
    </style>
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

        
        </div>
    </div>
</div>

</body>
</html>
