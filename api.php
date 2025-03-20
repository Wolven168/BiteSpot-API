<?php
// api.php - Main API router

header("Content-Type: application/json");

$request_uri = explode("?", $_SERVER['REQUEST_URI'], 2)[0];
$method = $_SERVER['REQUEST_METHOD'];

// Define API routes
switch (true) {
    case $request_uri === "/api/users/register" && $method === "POST":
        include_once "routes/userRoutes.php";
        break;

    case $request_uri === "/api/users/login" && $method === "POST":
        include_once "routes/userRoutes.php";
        break;

    case preg_match("/^\/api\/users\/\d+$/", $request_uri) && $method === "GET":
        include_once "routes/userRoutes.php";
        break;

    case $request_uri === "/api/locations" && $method === "GET":
        include_once "routes/locationRoutes.php";
        break;

    default:
        echo json_encode(["message" => "Invalid API endpoint"]);
}
?>
