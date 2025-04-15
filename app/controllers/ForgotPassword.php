<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
                    // Send OTP via email
                    $emailSent = $this->sendOTPEmail($email, $otp);

                    if ($emailSent) {
                        // Store email in session for the next step
                        $_SESSION['reset_email'] = $email;

                        // Redirect to OTP verification page
                        redirect('forgotpassword/verifyotp');
                        return;
                    } else {
                        $data['errors'] = ['Failed to send OTP email. Please try again.'];
                    }
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

    private function sendOTPEmail($email, $otp)
    {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                 // Enable verbose debug output
            $mail->isSMTP();                                         // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                // Enable SMTP authentication
            $mail->Username   = 'jeewanthadeherath04@gmail.com';             // SMTP username
            $mail->Password   = 'yslo ifas ehsz jroq';      // SMTP password (use App Password for Gmail)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      // Enable TLS encryption
            $mail->Port       = 587;                                 // TCP port to connect to

            // Recipients
            $mail->setFrom('jeewanthadeherath04@gmail.com', 'Themis Law Firm');
            $mail->addAddress($email);                               // Add a recipient

            // Content
            $mail->isHTML(true);                                     // Set email format to HTML
            $mail->Subject = 'Password Reset OTP - Themis';

            $mail->AddEmbeddedImage(__DIR__ . '/../../public/assets/images/themis_logo.png', 'logo', 'themis_logo.png');
            // Email body with OTP
            $mail->Body = '
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; }
        .header { background-color: #1d1b31; color: white; padding: 20px; text-align: center; }
        .logo { width: 120px; margin-bottom: 10px; }
        .content { padding: 20px; background-color: #f9f9f9; }
        .otp-box { font-size: 24px; font-weight: bold; text-align: center; padding: 10px; background-color: #e9ecef; margin: 20px 0; letter-spacing: 5px; }
        .footer { font-size: 12px; text-align: center; margin-top: 20px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="cid:logo" alt="Themis Logo" class="logo" />
            <h2>Password Reset Request</h2>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>We received a request to reset your password. Please use the following One-Time Password (OTP) to complete your password reset:</p>
            <div class="otp-box">' . $otp . '</div>
            <p>This OTP will expire in 15 minutes.</p>
            <p>If you didn’t request a password reset, please ignore this email.</p>
            <p>Thank you,<br>Themis Law Firm Team</p>
        </div>
        <div class="footer">
            <p>This is an automated message. Please do not reply.</p>
        </div>
    </div>
</body>
</html>';

            $mail->AltBody = "Your OTP for password reset is: $otp. This OTP will expire in 15 minutes.";

            $mail->send();
            return true;
        } catch (Exception $e) {
            // Log the error for debugging
            error_log("Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}
