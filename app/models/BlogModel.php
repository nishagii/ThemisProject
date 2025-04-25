<?php

class BlogModel {
    use Model;

    protected $table = 'blogs';

    public function save($data)
    {
        try {
            $query = "INSERT INTO {$this->table}
                      (title, content, image_url, author)
                      VALUES
                      (:title, :content, :image_url, :author)";

            $params = [
                'title' => $data['title'],
                'content' => $data['content'],
                'image_url' => $data['image_url'],
                'author' => $data['author'],
            ];

            return $this->query($query, $params);
        } catch (Exception $e) {
            error_log("Database Error [BlogModel:save]: " . $e->getMessage());
            return false;
        }
    }

    public function getAllBlogs()
    {
        try {
            $query = "SELECT * FROM {$this->table} ORDER BY blog_id DESC";
            return $this->query($query);
        } catch (Exception $e) {
            error_log("Database Error [BlogModel:getAllBlogs]: " . $e->getMessage());
            return false;
        }
    }

}
