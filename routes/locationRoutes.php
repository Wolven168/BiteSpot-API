<?php
// routes/locationRoutes.php

include_once '../config/db.php';
include_once '../models/Location.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['latitude']) && isset($_GET['longitude']) && isset($_GET['radius'])) {
        $latitude = $_GET['latitude'];
        $longitude = $_GET['longitude'];
        $radius = $_GET['radius'];

        $locations = Location::getLocationsWithinRadius($latitude, $longitude, $radius);
        echo json_encode($locations);
    } else {
        echo json_encode(["message" => "Missing parameters: latitude, longitude, and radius are required."]);
    }
}
?>
