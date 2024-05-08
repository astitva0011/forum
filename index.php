

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NectarOfService</title>
    
</head>
<body>
    <h1>💠Community Forum💠</h1>

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
