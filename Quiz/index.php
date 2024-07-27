<!DOCTYPE html>
<html>
<head>
    <?php
        include("../config.php");
        if (isset($_GET['id'])) {
            $quiz_id = $_GET['id'];
            if ($quiz_id == nulL) {
                header('Location: /quizlify/quizfinder/');
                exit();
            }
            $sql = "SELECT * FROM quizes WHERE id = :quiz_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':quiz_id', $quiz_id, PDO::PARAM_INT);
            $stmt->execute();

            $quiz = $stmt->fetch();

        } else {
            header('Location: /quizlify/quizfinder/');
            exit();
        }
    ?>
    <title>Quizlify: <?php echo $quiz['title']; ?></title>
    <link rel="stylesheet" type="text/css" href="./styles.css" />
</head>
<body>
    <h1 class='quiz-heading'>
        Quiz: <?php echo $quiz['title'];  ?>
    </h1>
    <div class="app-body">
        <h1 class="answer-key" style="display:none;">Answer Key</h1>
        <div class="question-card">
            <h2 id="question">Question</h2>
            <form>
                <input type="radio" id="op1" name="op" value="0">
                <label for="op1">op1</label><br>
                <input type="radio" id="op2" name="op" value="1">
                <label for="op2">op2</label><br>
                <input type="radio" id="op3" name="op" value="2">
                <label for="op3">op3</label><br>
                <input type="radio" id="op4" name="op" value="3">
                <label for="op4">op4</label><br>
                <div id="res" class="idle">Empty</div><br>
                <input type="submit" name="submit" value="Submit" class="submit" />
            </form>
        </div>
        <button>Restart</button>
    </div>
    <script src="./sandbox.js"></script>
</body>
</html>
