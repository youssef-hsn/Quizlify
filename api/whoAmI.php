<?php
if (!isset($_COOKIE['token'])) {
    header("Location: /quizlify/authentication/login/");
    exit();
}
if (!isset($_SESSION["user"])) {
   include "../config.php";
   $sql = "SELECT id, username, expires FROM users
           JOIN tokens ON tokens.user_id = users.id
           WHERE token = :token";
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':token', $_COOKIE['token'], PDO::PARAM_STR);
   $stmt->execute();
   $result = $stmt->fetch(PDO::FETCH_ASSOC);
   if (!$result || $result['expires'] < time()) {   
        header("Location: /quizlify/authentication/login/?message=Found Invalid token in your cookies");
        exit();
    }
    $_SESSION["user"] = array(
        "id" => $result['id'],
        "username" => $result['username']
    );

    if (!isset($_GET['greaterDestination'])) {
        header("Location: /quizlify/home/");
    }
    header("Location: " . $_GET['greaterDestination']);
}
?>