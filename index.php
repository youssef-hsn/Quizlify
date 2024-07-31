<?php
$request = $_SERVER['REQUEST_URI'];
echo $request;
$request = strtolower($_SERVER['REQUEST_URI']);
header('Location: /quizlify/home/');
?>