<?php
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Check if token is valid and not expired
    $current_time = date('Y-m-d H:i:s');
    $sql = "SELECT * FROM password_reset_tokens WHERE token = ? AND expiry_time > ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $token, $current_time);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Token is valid, allow user to reset password
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Reset password
            $new_password = $_POST["new_password"];
            // Update user's password in the database
            $update_sql = "UPDATE users SET password = ? WHERE user_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $new_password, $user_id);
            $update_stmt->execute();
            
            // Delete the used token
            $delete_sql = "DELETE FROM password_reset_tokens WHERE token = ?";
            $delete_stmt = $conn->prepare($delete_sql);
            $delete_stmt->bind_param("s", $token);
            $delete_stmt->execute();
            
            echo "Password reset successful.";
            // Redirect user to login page or any other appropriate page
            exit();
        }
?>
<h3>Reset Password</h3>
<form action="" method="POST">
    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" id="new_password" required><br><br>
    <button type="submit">Reset Password</button>
</form>
<?php
    } else {
        echo "Invalid or expired token.";
    }
} else {
    echo "Token not provided.";
}
?>
