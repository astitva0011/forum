<?php
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data from POST request
    $email = $_POST["email"];      

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $d_pass = $hashedPassword = $row['password'];
        $d_pass = $row['password'];
        $to = $email;
        $from = "noreply@astitva.com"; // Fixed email address
        $fromName = "Astitva";
        $subject = "Email Verification";
        $message = "Your password is: " . $d_pass;
        $headers = 'From: ' . $fromName . ' <' . $from . '>';
        $check = mail($to, $subject, $message, $headers);

        if ($check) {
            echo "Email sent successfully";
        } else {
            echo "Email not sent";
        }
    } else {
        echo "Email not found";
    }
}
?>

<h3>Forget Password</h3>
<p>Enter your email address to reset your password.</p>

<form action="forget.php" method="POST">
    <input type="email" name="email" placeholder="Email" id="email" required><br><br>
    <button type="submit">Get password</button>
</form>