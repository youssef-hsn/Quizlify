<?php
include "../config.php";

if (!isset($_POST['title']) || empty($_POST['title'])) {
    header("Location: /quizlify/createQuiz/");
}

$creator = $_POST['creator_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$questions = $_POST['questions'];


$pdo = new PDO($dsn, $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("INSERT INTO quizes (title, description, creator_id) VALUES (:title, :description, :user_id)");
$stmt->execute([
    'title' => $title,
    'description' => $description,
    'user_id' => $creator
]);
$quizId = $pdo->lastInsertId();

foreach ($questions as $question) {
    $stmt = $pdo->prepare("INSERT INTO questions (quiz_id, question_text) VALUES (:quiz_id, :question)");
    $stmt->execute([
        'quiz_id' => $quizId,
        'question' => $question
    ]);

    $questionId = $pdo->lastInsertId();

    foreach ($question['answers'] as $answer) {
        $stmt = $pdo->prepare("INSERT INTO options (question_id, option_text, points) VALUES (:question_id, :answer, :is_correct)");
        $stmt->execute([
            'question_id' => $questionId,
            'answer' => $answer['answer'],
            'points' => $answer['points']
        ]);
    }
}

header("Location: /quizlify/createQuiz/?id=$quizId");

if (isset($_POST['greaterDestination']) && !empty($_POST['greaterDestination'])) {
    header("Location: " . $_POST['greaterDestination']);
}  else {
    header("Location: /quizlify/home/");
}

?>