<?php
$request = $_SERVER['REQUEST_URI'];
echo $request;
$request = strtolower($_SERVER['REQUEST_URI']);
switch ($request) {
    case '/quizlify/':
        header('Location: /quizlify/home/');
    case '/login/':
        header('Location: /quizlify/authentication/login/');
    case '/register/':
        header('Location: /quizlify/authentication/register/');
    default:
        header('Location: /quizlify/home/');
}
?>