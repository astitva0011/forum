<?php
// Check if user is logged in
session_start();
if(isset($_SESSION['user_id'])) {
    // User is logged in
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    // Retrieve other user-specific data from session as needed
} else {
    // User is not logged in, handle accordingly (e.g., restrict access or redirect to login page)
    header("Location: login.php");
}

// Include the database connection script
    include 'dbconnect.php';

// Initialize variables
$question_row = $comments_result = null;

// Retrieve question details and comments based on question_id parameter
if(isset($_GET['question_id']) && is_numeric($_GET['question_id'])) {
    $question_id = $_GET['question_id'];
    
    // Prepare and execute query to fetch question details
    $question_sql = "SELECT * FROM questions WHERE question_id = ?";
    
    $stmt = $conn->prepare($question_sql);
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $question_result = $stmt->get_result();
    
    // Fetch question details if available
    if ($question_result->num_rows == 1) {
        $question_row = $question_result->fetch_assoc();
        
        // Prepare and execute query to fetch comments related to the question
        $comments_sql = "SELECT * FROM comments WHERE question_id = ? ORDER BY date ASC";
        $stmt = $conn->prepare($comments_sql);
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $comments_result = $stmt->get_result();
    } else { 
        // No question found with the given question_id
        echo "No question found.";
    }
    
    // Close statement
    $stmt->close();
} else {
    // Invalid question_id parameter
    echo "Invalid question ID.";
}
?>