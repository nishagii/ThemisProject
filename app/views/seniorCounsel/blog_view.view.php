<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/blog.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .blog-content {
            position: relative;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        .blog-content.collapsed {
            max-height: 100px; /* Adjust height as needed */
        }
        .read-more-btn {
            color: #4070f4;
            cursor: pointer;
            font-weight: bold;
            margin-top: 5px;
            display: inline-block;
            user-select: none;
        }
        .read-more-btn:hover {
            text-decoration: underline;
        }
        /* Add a fade effect at the bottom of collapsed content */
        .blog-content.collapsed::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40px;
            background: linear-gradient(transparent, rgba(255, 255, 255, 0.9));
        }
    </style>
</head>
<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    <div class="home-section">
        <div class="blog-container">
            <header>
                <h1>All Blogs</h1>
                <a href="<?= ROOT ?>/blog/addBlog" class="add-blog-button">Add Blog</a>
            </header>
            
            <main>
                <?php if (!empty($blogs)): ?>
                    <div class="blogs">
                        <?php foreach ($blogs as $blog): ?>
                            <div class="blog-item">
                                <?php if ($blog->image_url): ?>
                                    <div class="blog-image">
                                        <img src="<?= ROOT ?>/assets/blog_images/<?php echo htmlspecialchars($blog->image_url); ?>" alt="Blog Image">
                                    </div>
                                <?php endif; ?>
                                <h2><?php echo htmlspecialchars($blog->title); ?></h2>
                                
                                <?php
                                // Check if content is long enough to need a "Read More" button
                                $content = nl2br(htmlspecialchars($blog->content));
                                $contentLength = strlen(strip_tags($blog->content));
                                $needsReadMore = $contentLength > 300; // Adjust character limit as needed
                                ?>
                                
                                <div class="blog-content <?= $needsReadMore ? 'collapsed' : '' ?>" data-blog-id="<?= $blog->id ?>">
                                    <p><?= $content ?></p>
                                </div>
                                
                                <?php if ($needsReadMore): ?>
                                    <div class="read-more-btn" data-blog-id="<?= $blog->id ?>">
                                        Read More
                                    </div>
                                <?php endif; ?>
                                
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

    <script>
        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Add click event listeners to all read more buttons
            const readMoreButtons = document.querySelectorAll('.read-more-btn');
            
            readMoreButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const blogId = this.getAttribute('data-blog-id');
                    const contentDiv = document.querySelector(`.blog-content[data-blog-id="${blogId}"]`);
                    
                    if (contentDiv.classList.contains('collapsed')) {
                        contentDiv.classList.remove('collapsed');
                        this.textContent = 'Show Less';
                    } else {
                        contentDiv.classList.add('collapsed');
                        this.textContent = 'Read More';
                    }
                });
            });
        });
    </script>
</body>
</html>