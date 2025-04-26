<?php

class Feedback
{
    use Controller;

    // Display feedback form or list
    public function index()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        // Check user role and redirect accordingly
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'lawyer') {
            // For senior counsel, redirect to viewAll method
            redirect('feedback/viewAll');
            return;
        }

        // For clients, show their feedback with CRUD options
        $feedbackModel = $this->loadModel('FeedbackModel');
        $userId = $_SESSION['user_id'];
        
        // Get all feedback from the current user
        $feedbacks = $feedbackModel->getFeedbackByUserId($userId);
        
        $this->view('/client/feedback', [
            'feedbacks' => $feedbacks
        ]);
    }

    // Add new feedback
    public function add()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        // Prevent senior counsel from adding feedback
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'lawyer') {
            $_SESSION['error_message'] = 'Senior counsel cannot add feedback';
            redirect('feedback/viewAll');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'rating' => $_POST['rating'] ?? '',
                'description' => $_POST['description'] ?? '',
                'user_id' => $_SESSION['user_id'],
            ];

            // Validate the data
            $errors = [];
            if (empty($data['rating']) || !is_numeric($data['rating']) || $data['rating'] < 1 || $data['rating'] > 5) {
                $errors['rating'] = 'Please provide a valid rating between 1 and 5';
            }
            if (empty($data['description'])) {
                $errors['description'] = 'Description is required';
            }

            // If there are errors, render the form again with error messages
            if (!empty($errors)) {
                $this->view('/client/feedback', [
                    'errors' => $errors, 
                    'data' => $data
                ]);
                return;
            }

            // Save data to the database
            $feedbackModel = $this->loadModel('FeedbackModel');
            $result = $feedbackModel->save($data);

            if ($result) {
                // Set success message in session
                $_SESSION['success_message'] = 'Feedback submitted successfully';
            } else {
                $_SESSION['error_message'] = 'Failed to submit feedback';
            }

            // Redirect to feedback page
            redirect('feedback');
        } else {
            // If not POST request, show the form
            $this->view('/client/feedback');
        }
    }

    // Edit feedback
    public function edit($id = null)
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        // Prevent senior counsel from editing feedback
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'lawyer') {
            $_SESSION['error_message'] = 'Senior counsel cannot edit feedback';
            redirect('feedback/viewAll');
            return;
        }

        $feedbackModel = $this->loadModel('FeedbackModel');
        
        // Get the feedback to edit
        $feedback = $feedbackModel->getFeedbackById($id);
        
        // Check if feedback exists and belongs to the current user
        if (!$feedback || $feedback->user_id != $_SESSION['user_id']) {
            $_SESSION['error_message'] = 'You are not authorized to edit this feedback';
            redirect('feedback');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $id,
                'rating' => $_POST['rating'] ?? '',
                'description' => $_POST['description'] ?? '',
                'user_id' => $_SESSION['user_id'],
            ];

            // Validate the data
            $errors = [];
            if (empty($data['rating']) || !is_numeric($data['rating']) || $data['rating'] < 1 || $data['rating'] > 5) {
                $errors['rating'] = 'Please provide a valid rating between 1 and 5';
            }
            if (empty($data['description'])) {
                $errors['description'] = 'Description is required';
            }

            // If there are errors, render the form again with error messages
            if (!empty($errors)) {
                $this->view('/client/feedbackEdit', [
                    'errors' => $errors, 
                    'data' => $data,
                    'feedback' => $feedback
                ]);
                return;
            }

            // Update feedback in the database
            $result = $feedbackModel->updateFeedback($data);

            if ($result) {
                $_SESSION['success_message'] = 'Feedback updated successfully';
            } else {
                $_SESSION['error_message'] = 'Failed to update feedback';
            }

            redirect('feedback');
        } else {
            // Show edit form with current feedback data
            $this->view('/client/feedbackEdit', [
                'feedback' => $feedback
            ]);
        }
    }

    // Delete feedback
    public function delete($id = null)
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        // Prevent senior counsel from deleting feedback
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'lawyer') {
            $_SESSION['error_message'] = 'Senior counsel cannot delete feedback';
            redirect('feedback/viewAll');
            return;
        }

        $feedbackModel = $this->loadModel('FeedbackModel');
        
        // Get the feedback to delete
        $feedback = $feedbackModel->getFeedbackById($id);
        
        // Check if feedback exists and belongs to the current user
        if (!$feedback || $feedback->user_id != $_SESSION['user_id']) {
            $_SESSION['error_message'] = 'You are not authorized to delete this feedback';
            redirect('feedback');
            return;
        }

        // Delete feedback
        $result = $feedbackModel->deleteFeedback($id);

        if ($result) {
            $_SESSION['success_message'] = 'Feedback deleted successfully';
        } else {
            $_SESSION['error_message'] = 'Failed to delete feedback';
        }

        redirect('feedback');
    }

    // Method for senior counsel to view all feedback
    public function viewAll()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
            return;
        }

        // Check if user is a senior counsel
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'lawyer') {
            // If not senior counsel, redirect to regular feedback page
            redirect('feedback');
            return;
        }

        $feedbackModel = $this->loadModel('FeedbackModel');
        $feedbacks = $feedbackModel->getAllFeedback();
        
        $this->view('/seniorCounsel/all-feedback', [
            'feedbacks' => $feedbacks
        ]);
    }
}
