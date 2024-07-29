<!DOCTYPE html>
<html>
<head>
    <?php
        include("../config.php");
        if (isset($_GET['id'])) {
            $quiz_id = $_GET['id'];
            if ($quiz_id == null) {
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
        <form id="quiz-form">
            <div id="questions-container">
                <!-- Questions will be dynamically inserted here by JavaScript -->
            </div>
            <div id="res" class="idle">Empty</div><br>
            <input type="submit" name="submit" value="Submit" class="submit" />
        </form>
        <button style="display: none;">Restart</button>
    </div>
    <script src="./sandbox.js"></script>
</body>
</html>
