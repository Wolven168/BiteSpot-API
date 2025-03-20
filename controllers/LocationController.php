<?php
// controllers/LocationController.php

include_once '../config/db.php';
include_once '../models/Location.php';

class LocationController {

    public static function getLocations($latitude, $longitude, $radius) {
        if (!is_null($latitude) && !is_null($longitude) && !is_null($radius)) {
            $locations = Location::getLocationsWithinRadius($latitude, $longitude, $radius);
            return $locations;
        }
        return ["message" => "Missing required parameters."];
    }
}
?>
