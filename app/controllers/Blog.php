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
                header("Location: " . ROOT . "/blog/viewBlog");
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

    public function viewBlog()
    {
        // Load the BlogModel
        $blogModel = $this->loadModel('BlogModel');
        $blogs = $blogModel->getAllBlogs();

        if ($blogs) {
            // Pass the blog posts to the view for rendering
            $this->view('/seniorCounsel/blog_view', ['blogs' => $blogs]);
        } else {
            // If no blogs are found, show an error message or a placeholder
            $_SESSION['error'] = "No blogs available.";
            $this->view('/seniorCounsel/blog_view', ['blogs' => []]);
        }
    }

    public function details($id)
    {
        // Load the BlogModel
        $blogModel = $this->loadModel('BlogModel');

        // Fetch the blog by ID
        $blog = $blogModel->getBlogById($id);

        if ($blog) {
            
            $this->view('/seniorCounsel/blog_detail', ['blog' => $blog]);
        } else {
            
            $_SESSION['error'] = "Blog not found.";
            header("Location: " . ROOT . "/blog/viewBlog");
            exit;
        }
    }

    public function delete($id)
    {
        $blogModel = $this->loadModel('BlogModel');

        
        $blog = $blogModel->getBlogById($id);

        if (!$blog) {
            $_SESSION['error'] = "Blog post not found.";
            header("Location: " . ROOT . "/blog/viewBlog");
            exit;
        }

        
        $deleted = $blogModel->deleteBlogById($id);

        if ($deleted) {
            $_SESSION['success'] = "Blog post deleted successfully.";
        } else {
            $_SESSION['error'] = "Failed to delete blog post.";
        }

        header("Location: " . ROOT . "/blog/viewBlog");
        exit;
    }

    public function editBlog($id)
    {
        // Load the BlogModel
        $blogModel = $this->loadModel('BlogModel');

        // Fetch the blog by ID
        $blog = $blogModel->getBlogById($id);

        if ($blog) {
            // Pass the blog data to the view for editing
            $this->view('/seniorCounsel/blog_edit', ['blog' => $blog]);
        } else {
            $_SESSION['error'] = "Blog not found.";
            header("Location: " . ROOT . "/blog/viewBlog");
            exit;
        }
    }

    public function updateBlog($id)
    {
        // Load the BlogModel
        $blogModel = $this->loadModel('BlogModel');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize inputs
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

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
                    header("Location: " . ROOT . "/blog/editBlog/$id");
                    exit;
                }

                if (!move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetFile)) {
                    $_SESSION['error'] = "Failed to upload cover image.";
                    header("Location: " . ROOT . "/blog/editBlog/$id");
                    exit;
                }
            }

            $blogData = [
                'title' => $title,
                'content' => $content,
                'image_url' => $imageFileName ?? null
            ];

            // Update the blog post
            $result = $blogModel->updateBlogById($id, $blogData);

            if ($result) {
                $_SESSION['success'] = "Blog post updated successfully!";
                header("Location: " . ROOT . "/blog/viewBlog");
            } else {
                $_SESSION['error'] = "Failed to update blog post.";
                header("Location: " . ROOT . "/blog/editBlog/$id");
            }
            exit;
        } else {
            header("Location: " . ROOT . "/blog/editBlog/$id");
            exit;
        }
    }




}
