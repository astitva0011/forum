<?php

include 'dbconnect.php';

// Include the CSS file
echo '<link rel="stylesheet" type="text/css" href="http://localhost/forum/styles.css">';

// Set the limit and offset for pagination
$limit = 4;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query to fetch questions for the current page
$sql = "SELECT * FROM questions ORDER BY question_id DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display questions
    while ($row = $result->fetch_assoc()) {
        echo "<div class='question'>";
        echo "<a href='question_page.php?question_id=" . $row["question_id"] . "'><h3><strong>Question:</strong> " . $row["question_text"] . "</a><br></h3>";
        echo "<h4><strong>Date:</strong> " . $row["date"] . "</p></h4>";
        echo "</div>";
        echo "<hr>";
    }

    // Pagination container
    echo "<div class='pagination-container'>";

    // Add back button
    if ($page > 2) {
        $prevPage = $page - 1;
        echo "<a href='show_questions.php?page=$prevPage' class='pagination-button'>Back</a>";
    } elseif ($page > 1) {
        echo "<a href='index.php' class='pagination-button'>Home</a>"; // Link to home page when on the first page
    }

    // Add next button
    $nextPage = $page + 1;
    echo "<a href='show_questions.php?page=$nextPage' class='pagination-button'>Next</a>";

    echo "</div>"; // End of pagination container

} elseif($result->num_rows < 1){
    echo "No Furthure questions","<a href='index.php' class='pagination-button'>Home</a>";
}

$conn->close();
?>