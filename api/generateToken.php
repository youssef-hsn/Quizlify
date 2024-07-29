<?php
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing username or password']);
    exit();
} 

$username = $_POST['username'];
$password = $_POST['password']; 

include("../config.php");

$sql = "SELECT id, password FROM users WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$result || !password_verify($password, $result['password'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid username or password']);
    exit();
}

header('Content-Type: application/json');
$token = hash('sha256', $username . time());

$sql = "DELETE FROM tokens WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $result['id'], PDO::PARAM_INT);
$stmt->execute();

$expires = date('Y-m-d H:i:s', strtotime('+1 day'));
$sql = "INSERT INTO tokens (user_id, token, expires) VALUES (:user_id, :token, :expires)";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $result['id'], PDO::PARAM_INT);
$stmt->bindParam(':token', $token, PDO::PARAM_STR);
$stmt->bindParam(':expires', $expires, PDO::PARAM_STR);
$stmt->execute();

setcookie('token', $token, time() + 86400, "/");
$_SESSION["user"] = array(
    "id" => $result['id'],
    "username" => $username
);

if (isset($_POST['greaterDestination']) && !empty($_POST['greaterDestination'])) {
    header("Location: " . $_POST['greaterDestination']);
}  else {
    header("Location: /quizlify/home/");
}

?>