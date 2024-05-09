<?php
// Start session
// Check if user is logged in
session_start();
if(isset($_SESSION['userid'])) {
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

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $question = $_POST['question'];

    // Check if the question already exists
    $check_query = "SELECT question_id FROM questions WHERE question_text = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $question);
    $stmt->execute();
    $stmt->store_result();

    // If the question already exists, redirect the user to the existing question page
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($question_id);
        $stmt->fetch();
        header("Location: question_page.php?id=$question_id");
        exit();
    }

    // Prepare and execute the SQL query to insert the question into the database
    $insert_query = "INSERT INTO questions (question_text) VALUES (?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("s", $question);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        $message = "Question submitted successfully.";
    } else {
        $message = "Error submitting question.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();

// Redirect back to the index page
header("Location: index.php?message=" . urlencode($message));
exit(); // Ensure that no further code is executed after the redirection
?>
