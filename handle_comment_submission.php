<?php

include 'dbconnect.php'; // Include the database connection script

// Handle comment submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment_text']) && isset($_POST['question_id'])) {
    $comment_text = $_POST['comment_text'];
    $question_id = $_POST['question_id'];
    $username = $_SESSION['username']; // Assuming the username is stored in the session

    // Insert the new comment into the database
    $insert_comment_sql = "INSERT INTO comments (question_id, comment_text) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_comment_sql);
    if ($stmt) {
        $stmt->bind_param("is", $question_id, $comment_text);
        if ($stmt->execute()) {
            // Comment insertion successful
            header("Location: question_page.php?question_id=$question_id");
            exit;
        } else {
            // Error executing query
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Error preparing statement
        echo "Error: " . $conn->error;
    }
}

// Fetch comments for the corresponding question from the database
if (isset($_GET['id'])) {
    $question_id = $_GET['id'];
    $get_comments_sql = "SELECT * FROM comments WHERE question_id = ?";
    $stmt = $conn->prepare($get_comments_sql);
    if ($stmt) {
        $stmt->bind_param("i", $question_id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            // Display comments
            while ($row = $result->fetch_assoc()) {
                // Output each comment
    
                echo "<p>{$row['comment_text']}</p>";
            }
        } else {
            // Error executing query
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Error preparing statement
        echo "Error: " . $conn->error;
    }
}

?>
