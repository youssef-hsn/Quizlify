<?php
include "../config.php";

header('Content-Type: application/json');
if (isset($_POST['value'])) {
    $value = $_POST['value'];
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Missing value']);
    exit();
}

if (isset($_POST['table'])) {
    $table = $_POST['table'];
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Missing table']);
    exit();
}

if (isset($_POST['column'])) {
    $column = $_POST['column'];
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Missing column']);
    exit();
}
if ($column == 'password') {
    http_response_code(400);
    echo json_encode(['error' => 'This may cause security risks']);
    exit();
}

$stmt = $pdo->prepare("SELECT $column FROM $table WHERE $column = :value");
$stmt->bindParam(':value', $value, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll();

echo json_encode(['isValid' => count($result) == 0]);
exit();
?>