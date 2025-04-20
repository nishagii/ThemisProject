<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Add New Blog Post</h2>

    <form action="<?php echo ROOT; ?>/blog/saveBlog" method="POST" enctype="multipart/form-data">
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="content">Content:</label>
            <textarea name="content" id="content" rows="10" required></textarea>
        </div>

        <div>
            <label for="cover_image">Cover Image (Optional):</label>
            <input type="file" name="cover_image" id="cover_image" accept="image/*">
        </div>

        <div>
            <button type="submit">Save Blog</button>
        </div>
    </form>
</body>
</html>