<?php
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
    if ($stmt) {
        $stmt->bind_param("i", $question_id);
        if ($stmt->execute()) {
            $question_result = $stmt->get_result();
            
            // Fetch question details if available
            if ($question_result->num_rows == 1) {
                $question_row = $question_result->fetch_assoc();
                
                // Prepare and execute query to fetch comments related to the question
                $comments_sql = "SELECT * FROM comments WHERE question_id = ? ORDER BY date ASC";
                $stmt = $conn->prepare($comments_sql);
                if ($stmt) {
                    $stmt->bind_param("i", $question_id);
                    if ($stmt->execute()) {
                        $comments_result = $stmt->get_result();
                    } else {
                        // Error executing query
                        echo "Error: " . $stmt->error;
                    }
                } else {
                    // Error preparing statement
                    echo "Error: " . $conn->error;
                }
            } else { 
                // No question found with the given question_id
                echo "No question found.";
            }
        } else {
            // Error executing query
            echo "Error: " . $stmt->error;
        }
        // Close statement
        $stmt->close();
    } else {
        // Error preparing statement
        echo "Error: " . $conn->error;
    }
} else {
    // Invalid question_id parameter
    echo "Invalid question ID.";
}

?>
