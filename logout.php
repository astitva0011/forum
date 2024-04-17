<?php
// Start session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page or wherever you want to go after logout
header("Location: login.php");
exit();
?>
// Compare this snippet from index.php:
// <?php
// // Start session
// session_start();
//
// // Check if the user is logged in
// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit();
// }
//
// // Include the database connection script
// include 'dbconnect.php';
//
// // Fetch and display user-specific data
// $username = $_SESSION['username'];
// $sql = "SELECT * FROM users WHERE username = ?";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("s", $username);
// $stmt->execute();
// $result = $stmt->get_result();
//
// if ($result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     echo "Welcome, " . $row['username'];
//     // Display user-specific data
// } else {
//     echo "User not found.";
// }
//
// // Close the statement and database connection

// $stmt->close();
// $conn->close();
// ?>

