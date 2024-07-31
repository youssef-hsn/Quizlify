<?php
include "../config.php";

$_COOKIE['token'] = null;
session_destroy();
header('Location: /quizlify/home/');
?>