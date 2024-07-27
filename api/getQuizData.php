<?php
header('Content-Type: application/json');

$host = 'localhost';
$db = 'quizlify';
$user = 'root'; // Change this to your database user
$pass = ''; // Change this to your database password

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $quiz_id = 1; // Assuming you want to fetch quiz with id 1

    // Fetch quiz information
    $quizStmt = $pdo->prepare("SELECT * FROM quizes WHERE id = :quiz_id");
    $quizStmt->execute(['quiz_id' => $quiz_id]);
    $quiz = $quizStmt->fetch(PDO::FETCH_ASSOC);

    // Fetch questions and options
    $questionsStmt = $pdo->prepare("SELECT * FROM questions WHERE quiz_id = :quiz_id");
    $questionsStmt->execute(['quiz_id' => $quiz_id]);
    $questions = $questionsStmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($questions as &$question) {
        $optionsStmt = $pdo->prepare("SELECT * FROM options WHERE question_id = :question_id");
        $optionsStmt->execute(['question_id' => $question['id']]);
        $question['options'] = $optionsStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode([
        'quiz' => $quiz,
        'questions' => $questions
    ]);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
    