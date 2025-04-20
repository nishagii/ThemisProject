<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Blogs</title>
</head>
<body>

    <header>
        <h1>All Blogs</h1>
    </header>

    <main>

        <?php if (!empty($blogs)): ?>
            <div class="blogs">
                <?php foreach ($blogs as $blog): ?>
                    <h2><?php echo htmlspecialchars($blog->title); ?></h2>
                    <p><?php echo nl2br(htmlspecialchars($blog->content)); ?></p>
                    <?php if ($blog->image_url): ?>
                        <div class="blog-image">
                            <img src="<?= ROOT ?>/assets/blog_images/<?php echo htmlspecialchars($blog->image_url); ?>" alt="Blog Image">
                        </div>
                    <?php endif; ?>
                    <div class="blog-footer">
                        <p>Written by: <?php echo htmlspecialchars($blog->author); ?></p>
                        <p>Published on: <?php echo htmlspecialchars($blog->created_at); ?></p>
                    </div>

                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No blogs available.</p>
        <?php endif; ?>
    </main>

</body>
</html>