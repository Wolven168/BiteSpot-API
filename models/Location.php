<?php
// models/Location.php

class Location {
    public $id;
    public $name;
    public $address;
    public $latitude;
    public $longitude;
    public $rating;
    public $description;

    public function __construct($id = null, $name = "", $address = "", $latitude = 0.0, $longitude = 0.0, $rating = 0, $description = "") {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->rating = $rating;
        $this->description = $description;
    }

    public static function getLocationsWithinRadius($latitude, $longitude, $radius) {
        global $pdo;

        $sql = "SELECT * FROM locations";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $filteredLocations = [];
        foreach ($locations as $location) {
            // Calculate the distance using the Haversine formula
            $distance = self::haversine($latitude, $longitude, $location['latitude'], $location['longitude']);
            if ($distance <= $radius) {
                $filteredLocations[] = $location;
            }
        }

        return $filteredLocations;
    }

    private static function haversine($lat1, $lon1, $lat2, $lon2) {
        $R = 6371;  // Earth radius in kilometers
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $R * $c;  // Distance in kilometers
        return $distance;
    }
}
?>
