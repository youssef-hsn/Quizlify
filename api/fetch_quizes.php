<?php
include "../config.php";

$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

if ($limit > 20) {
    http_response_code(403);
    echo json_encode(array("message" => "Forbidden: Limit can't Exceed 20."));
    exit();
}
// Fetch quizzes with pagination
$sql = "SELECT id, title, description FROM quizes ORDER BY popularity DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

$quizzes = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $quizzes[] = $row;
    }
} else {
    echo "you have reached the end of our extensive list";
}

echo json_encode($quizzes);

$conn->close();
?>