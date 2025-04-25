<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Post</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/blog.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    <div class="home-section">
        <div class="form-container">
            <h2>Edit Blog Post</h2>

            <form action="<?php echo ROOT; ?>/blog/updateBlog/<?= $blog->blog_id ?>" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" value="<?= htmlspecialchars($blog->title) ?>" required>
                </div>

                <div>
                    <label for="content">Content:</label>
                    <textarea name="content" id="content" rows="10" required><?= htmlspecialchars($blog->content) ?></textarea>
                </div>

                <div>
                    <label for="cover_image">Cover Image (Optional):</label>
                    <div class="file-input-container">
                        <input type="file" name="cover_image" id="cover_image" accept="image/*">
                        <label for="cover_image">Choose File</label>
                        <span class="file-name"><?= $blog->image_url ? basename($blog->image_url) : 'No file chosen' ?></span>
                    </div>
                    <div class="image-preview" style="display: <?= $blog->image_url ? 'block' : 'none' ?>;">
                        <img id="preview-image" src="<?= ROOT ?>/public/assets/blog_images/<?= $blog->image_url ?>" alt="Preview">
                    </div>
                </div>

                <div>
                    <button type="submit">Update Blog</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('cover_image').addEventListener('change', function(e) {
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
                // Hide preview if no file is selected
                document.querySelector('.image-preview').style.display = 'none';
            }
        });
    </script>
</body>
</html>
