<?php
// routes/userRoutes.php

include_once '../controllers/UserController.php';
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);
$request_uri = explode("?", $_SERVER['REQUEST_URI'], 2)[0];

if ($request_uri === "/api/users/register" && $method === "POST") {
    echo json_encode(UserController::registerUser($input));
} elseif ($request_uri === "/api/users/login" && $method === "POST") {
    echo json_encode(UserController::loginUser($input));
} elseif (preg_match("/^\/api\/users\/(\d+)$/", $request_uri, $matches) && $method === "GET") {
    echo json_encode(UserController::getUserById($matches[1]));
} else {
    echo json_encode(["message" => "Invalid user request."]);
}
?>
