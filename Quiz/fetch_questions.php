<?php
include "config.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you want to fetch questions for a specific quiz
$quiz_id = 1; // replace with the actual quiz_id you want to fetch questions for

$sql = "SELECT q.id as question_id, q.question_text, o.id as option_id, o.option_text, o.points
        FROM questions q
        JOIN options o ON q.id = o.question_id
        WHERE q.quiz_id = $quiz_id";
        
$result = $conn->query($sql);

$questions = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
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
}

$conn->close();

echo json_encode(array_values($questions));
?>
