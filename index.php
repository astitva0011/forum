<?php
// index.php

// Start session
session_start();

// Check if user is logged in
if(isset($_SESSION['user_id'])) {
    // User is logged in
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    // Retrieve other user-specific data from session as needed
} else {
    // User is not logged in, handle accordingly (e.g., restrict access or redirect to login page)
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NectarOfService</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h1>🖋 <i>Discussion Forum</i> 🖋</h1>
    <h2>Welcome, <?php echo $username; ?>🐾!</h2></i>
    <main>

        <!-- Button to open the popup form -->
        <button class="askq" onclick="openForm()">Ask Question</button>

        <!-- Semi-transparent overlay -->
        <div class="overlay" id="overlay" onclick="closeForm()"></div>

        <!-- Popup form -->
        <div class="form-popup" id="myForm">
            <button type="button" class="close" onclick="closeForm()">x</button>
            <form action="asked_question.php" method="POST" class="form-container">
                <h2>Ask a Question</h2>
                <label for="question">Your Question:</label><br>
                <textarea id="question" name="question" rows="4" cols="50" placeholder="Ask meaningful questions, you can start them with 'what' or 'how' and end with '?' mark." required></textarea><br>
                <button type="submit" class="btn">Submit</button>
            </form>
        </div>
        
        <div class="sidebar">
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Search for questions">
                <button type="submit">Search</button>
            </form>
        </div>

        <section class="question-list">
            <div class="question">
                <h2>Latest Question</h2>
                <p class="author">
                    <?php include 'show_questions.php'; ?>
                </p>
            </div>
        </section>

        <form action="login.php" method="POST">
            <button type="submit" class="btn">Logout</button>
        </form>
    </main>

    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }
    </script>

</body>
</html>
