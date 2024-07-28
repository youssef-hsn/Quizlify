<?php
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing username or password']);
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username) || empty($password)) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing username or password']);
    exit();
}

if (strlen($password) < 8) {
    http_response_code(400);
    echo json_encode(['error' => 'Password must be at least 8 characters long']);
    exit();
}


$hasUpper = preg_match('@[A-Z]@', $password);
$hasLower = preg_match('@[a-z]@', $password);
$hasNumber = preg_match('@[0-9]@', $password);

if (!$hasUpper || !$hasLower || !$hasNumber) {
    http_response_code(400);
    echo json_encode(['error' => 'Password must contain one uppercase letter, one lowercase letter, and one number']);
    exit();
}

include "../config.php";


$sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
$stmt->execute();


header('Location: /quizlify/authentication/login/?destination=/quizlify/home/&message=Account created successfully. Please log in now.');
?>