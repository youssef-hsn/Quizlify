<?php
include "../config.php";

header('Content-Type: application/json');

$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

if ($limit > 20) {
    http_response_code(403);
    echo json_encode(array("message" => "Forbidden: Limit can't exceed 20."));
    exit();
}

try {
    $sql = "SELECT id, title, description FROM quizes ORDER BY popularity DESC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $quizzes = $stmt->fetchAll();

    if (empty($quizzes)) {
        http_response_code(404);
        echo json_encode(array("message" => "Not Found: you have exhausted our list"));
    } else {
        echo json_encode($quizzes);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array("message" => "Internal Server Error: " . $e->getMessage()));
}
?>
