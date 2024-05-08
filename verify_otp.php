<?php
//include database
include 'dbconnect.php';

// Function to generate OTP
function generateOTP($length = 6) {
    $otp = "";
    $chars = "0123456789";
    $char_count = strlen($chars);
    for ($i = 0; $i < $length; $i++) {
        $otp .= $chars[rand(0, $char_count - 1)];
    }
    return $otp;
}

// Function to send OTP email
function sendOTPEmail($email, $otp) {
    $subject = "Email Verification OTP";
    $message = "Your OTP is: " . $otp;
    // You can use PHP's mail() function or a library like PHPMailer to send emails
    mail($email, $subject, $message);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $otp = generateOTP();
    sendOTPEmail($email, $otp);
    // Store the OTP in session or database for verification
    session_start();
    $_SESSION["otp"] = $otp;
    $_SESSION["email"] = $email;
    // Redirect to OTP verification page
    header("Location: verify_otp.php");
    exit();
    $email = "astitv87@gmail.com";
    $otp = generateOTP(); // Generate OTP
    sendOTPEmail($email, $otp); // Send OTP to your email
    


}

?>

<!-- HTML form for user signup -->
<form method="post">
    <input type="email" name="email" placeholder="Enter your email" required>
    <button type="submit">Sign Up</button>
</form>
