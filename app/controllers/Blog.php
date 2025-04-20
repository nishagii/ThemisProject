<?php

class Blog
{
    use Controller;

    public function index()
    {

        $this->view('/landingPage/blog');
    }

    public function addBlog()
    {
        $this->view('/seniorCounsel/blog_add');
    }

    public function saveBlog()
    {
        $blogModel = $this->loadModel('BlogModel');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize inputs
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

            // Default values for now
            $authorID = 13; // Replace with actual user ID from session
            $createdAt = date('Y-m-d H:i:s');

            // Optional: Handle a cover image upload
            $imageFileName = null;
            if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
                $imageFileName = uniqid() . '_' . basename($_FILES['cover_image']['name']);
                $targetDir = "../public/assets/blog_images/";

                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                $targetFile = $targetDir . $imageFileName;
                $allowedTypes = ['jpg', 'jpeg', 'png', 'webp'];

                $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                if (!in_array($fileType, $allowedTypes)) {
                    $_SESSION['error'] = "Only JPG, JPEG, PNG, and WEBP images are allowed.";
                    header("Location: " . ROOT . "/blog/addBlog");
                    exit;
                }

                if (!move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetFile)) {
                    $_SESSION['error'] = "Failed to upload cover image.";
                    header("Location: " . ROOT . "/blog/addBlog");
                    exit;
                }
            }

            $blogData = [
                'title' => $title,
                'content' => $content,
                'author' => $authorID,         // Changed from 'author_id' to 'author'
                'created_at' => $createdAt,
                'image_url' => $imageFileName ?? null  // Changed from 'cover_image' to 'image_url'
            ];

            $result = $blogModel->save($blogData);

            if ($result) {
                $_SESSION['success'] = "Blog post added successfully!";
                header("Location: " . ROOT . "/blog/index");
            } else {
                $_SESSION['error'] = "Failed to save blog post.";
                header("Location: " . ROOT . "/blog/addBlog");
            }
            exit;
        } else {
            header("Location: " . ROOT . "/blog/addBlog");
            exit;
        }
    }

}
