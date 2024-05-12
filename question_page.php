<?php



// Your HTML content and PHP code for index.php here


include 'handle_comment_submission.php'; 
include 'retrieve_question_details.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Question Page</title>
    
</head>
<body>
    <h2>Comments</h2>
    <?php if(isset($comments_result) && $comments_result->num_rows > 0): ?>
        <div class="comments">
            <?php while($comment_row = $comments_result->fetch_assoc()): ?>
                <div class="comment">
                    <h3><strong><?php echo $comment_row["comment_text"]; ?></h3>
                    <h4><strong>Comment ID:</strong> <?php echo $comment_row["comment_id"]; ?></h4>
                    <h4><strong>Date:</strong> <?php echo $comment_row["date"]; ?></h4>
                </div>
            <?php endwhile; 
            ?>
        </div>
    <?php else: ?>
        <p>No comments found.</p>
    <?php endif; ?>

    <h1>Question</h1>
     <?php if(isset($question_row)): ?>
        <div class="question">
            <h3>Question: <strong> <?php echo $question_row["question_text"]; ?></h3>
            <h4>Question id: <?php echo $question_row["question_id"]; ?></p></h4>
            <h4><strong>Date: </strong> <?php echo $question_row["date"]; ?></p><br></h4>
        </div>
    <?php else: ?>
        <p>No question found.</p>
    <?php endif; ?>

 
    <div class="comment_form">
        <?php include 'comment_form.php'; // Include the file for the comment form ?>
    </div>
</body>
</html>
