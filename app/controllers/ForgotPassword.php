<?php

class ForgotPassword
{
    use Controller;

    public function index()
    {
        $data = [];
        $this->view('/landingPage/forgot_password', $data);
    }

    public function requestReset()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = $_POST['email'] ?? '';

            if (empty($email)) {
                $data['errors'] = ['Email is required'];
                $this->view('/landingPage/forgot_password', $data);
                return;
            }

            $userModel = $this->loadModel('UserModel');

            // Check if email exists
            if ($userModel->emailExists($email)) {
                // Generate OTP
                $otp = $this->generateOTP();

                // Save OTP in database
                if ($userModel->saveResetOTP($email, $otp)) {
                    // In a real application, you would send this OTP via email
                    // For now, we'll just store it in session for demo purposes
                    $_SESSION['reset_email'] = $email;

                    // Redirect to OTP verification page
                    redirect('forgotpassword/verifyotp');
                    return;
                } else {
                    $data['errors'] = ['Failed to process your request. Please try again.'];
                }
            } else {
                $data['errors'] = ['Email not found in our records'];
            }
        }

        $this->view('/landingPage/forgot_password', $data);
    }

    public function verifyOTP()
    {
        $data = [];

        if (!isset($_SESSION['reset_email'])) {
            redirect('forgotpassword');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $otp = $_POST['otp'] ?? '';

            if (empty($otp)) {
                $data['errors'] = ['OTP is required'];
                $this->view('/landingPage/verify_otp', $data);
                return;
            }

            $userModel = $this->loadModel('UserModel');

            // Verify OTP
            if ($userModel->verifyOTP($_SESSION['reset_email'], $otp)) {
                // Mark OTP as verified
                $_SESSION['otp_verified'] = true;

                // Redirect to reset password page
                redirect('forgotpassword/resetpassword');
                return;
            } else {
                $data['errors'] = ['Invalid OTP. Please try again.'];
            }
        }

        $this->view('/landingPage/verify_otp', $data);
    }

    public function resetPassword()
    {
        $data = [];

        if (!isset($_SESSION['reset_email']) || !isset($_SESSION['otp_verified'])) {
            redirect('forgotpassword');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if (empty($password) || strlen($password) < 2) {
                $data['errors'] = ['Password must be at least 2 characters long'];
                $this->view('/landingPage/reset_password', $data);
                return;
            }

            if ($password !== $confirm_password) {
                $data['errors'] = ['Passwords do not match'];
                $this->view('/landingPage/reset_password', $data);
                return;
            }

            $userModel = $this->loadModel('UserModel');

            // Update password
            if ($userModel->updatePassword($_SESSION['reset_email'], $password)) {
                // Clear session variables
                unset($_SESSION['reset_email']);
                unset($_SESSION['otp_verified']);

                // Redirect to login with success message
                redirect('login?reset=success');
                return;
            } else {
                $data['errors'] = ['Failed to update password. Please try again.'];
            }
        }

        $this->view('/landingPage/reset_password', $data);
    }

    private function generateOTP()
    {
        // Generate a 6-digit OTP
        return str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }
}

