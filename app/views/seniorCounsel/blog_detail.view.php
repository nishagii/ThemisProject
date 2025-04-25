<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($blog->title) ?> - Blog Details</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/blog.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
            <a href="<?= ROOT ?>/blog/editBlog/<?= $blog->blog_id ?>" class="edit-btn"><i class="bx bx-edit"></i> Edit</a>
            <a href="#" class="delete-btn" data-id="<?= $blog->blog_id ?>">
                <i class="bx bx-trash"></i> Delete
            </a>

        </div>

        
        </div>
    </div>
</div>

<script>
    document.querySelector('.delete-btn').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default anchor click
        const blogId = this.getAttribute('data-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the delete URL
                window.location.href = `<?= ROOT ?>/blog/delete/${blogId}`;
            }
        });
    });
</script>


</body>
</html>
