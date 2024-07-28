<?php
include "../config.php";

// Check if the connection is successful
if (!$pdo) {
    die("Connection failed: Unable to connect to the database.");
}

// Fetch quiz_id from GET parameter
$quiz_id = isset($_GET['id']) ? intval($_GET['id']) : 1; // Default to 1 if not set

// Prepare and execute the SQL statement
$sql = "SELECT q.id as question_id, q.question_text, o.id as option_id, o.option_text, o.points
        FROM questions q
        JOIN options o ON q.id = o.question_id
        WHERE q.quiz_id = :quiz_id";
        
$stmt = $pdo->prepare($sql);
$stmt->execute(['quiz_id' => $quiz_id]);

$questions = array();

while ($row = $stmt->fetch()) {
    $question_id = $row['question_id'];
    if (!isset($questions[$question_id])) {
        $questions[$question_id] = array(
            'title' => $row['question_text'],
            'options' => array(),
            'answer' => null,
            'score' => null
        );
    }
    $option = array(
        'option_text' => $row['option_text'],
        'points' => $row['points']
    );
    $questions[$question_id]['options'][] = $option['option_text'];
    if ($option['points'] == 1) {
        $questions[$question_id]['answer'] = count($questions[$question_id]['options']) - 1;
        $questions[$question_id]['score'] = $option['points'];
    }
}

// Output JSON-encoded result
echo json_encode(array_values($questions));
?>
