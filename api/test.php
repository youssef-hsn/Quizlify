<?php
http_response_code(200);

$response = array("status" => "200", "message" => "API is up");
header('Content-Type: application/json');
echo json_encode($response);
?>
