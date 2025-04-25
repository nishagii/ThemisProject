<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/blog.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    <div class="home-section">
        <div class="blog-container">
            <header>
                <h1>All Blogs</h1>
                <a href="<?= ROOT ?>/seniorCounsel/addBlog" class="add-blog-button">Add Blog</a>
            </header>
            
            <main>
                <?php if (!empty($blogs)): ?>
                    <div class="blogs">
                        <?php foreach ($blogs as $blog): ?>
                            <div>
                                <?php if ($blog->image_url): ?>
                                    <div class="blog-image">
                                        <img src="<?= ROOT ?>/assets/blog_images/<?php echo htmlspecialchars($blog->image_url); ?>" alt="Blog Image">
                                    </div>
                                <?php endif; ?>
                                <h2><?php echo htmlspecialchars($blog->title); ?></h2>
                                <p><?php echo nl2br(htmlspecialchars($blog->content)); ?></p>
                                <div class="blog-footer">
                                    <p>By <?php echo htmlspecialchars($blog->author); ?></p>
                                    <p><?php echo date('M j, Y', strtotime($blog->created_at)); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No blogs available at the moment.</p>
                <?php endif; ?>
            </main>
        </div>
    </div>
</body>
</html>