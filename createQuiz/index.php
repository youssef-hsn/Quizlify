<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>Create your own quiz</title>
    <?php 
        if (!isset($_COOKIE['token'])) {
            header("Location: /quizlify/authentication/login/?message=You must be logged in to create a quiz&greaterDestination=/quizlify/createQuiz/");
        }
        
        include "../config.php";

        if (!isset($_SESSION["user"])) {
            header("Location: /quizlify/api/whoAmI.php?greaterDestination=/quizlify/createQuiz/");
        }
    ?>
</head>
<body>
    <h1>Create your own quiz</h1>
    
    <h2>Quiz Details</h2>
    <label for="title">Title <img id="isValidTitle" src="" alt=""></label>
    <input class="mb" type="text" name="title" id="title">
    <br>
    <label for="description">Description</label>
    <textarea class="mb" name="description"></textarea>

    <h2>Questions</h2>
    <ol id="questions">
        <li id="template">
            <label for="question">Question</label>
            <input type="text" name="question">
            <h4>Answers: </h4>
            <ol id="answers">
                <li>
                    <label for="answer">Corect Answer</label>
                    <input type="text" name="answer">
                    <input class="answer-points" type="number" name="points" value=1 disabled>
                </li>
                <li>
                    <input type="text" name="answer">
                    <input class="answer-points" type="number" name="points" value=0 disabled>
                </li>
                <li>
                    <input type="text" name="answer">
                    <input class="answer-points" type="number" name="points" value=0 disabled>
                </li>
                <li>
                    <input type="text" name="answer">
                    <input class="answer-points" type="number" name="points" value=0 disabled>
                </li>
            </ol>
            <button onclick="deleteQuestion(this)">Delete Question</button>
        </li>
    </ol>
    <button id="add-question">New Question</button>

    <button id="create-quiz">Create Quiz</button>
</body>
</html>