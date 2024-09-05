<?php

function calculateDistance($lat1, $lon1, $lat2, $lon2) {
    $earthRadius = 6371; //Radio de la Tierra en kilómetros
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);

    $latDiff = $lat2 - $lat1;
    $lonDiff = $lon2 = $lon1;

    $a = sin($latDiff / 2) * sin($latDiff / 2) +
        cos($lat1) * cos($lat2) *
        sin($lonDiff / 2) * sin($lonDiff / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $earthRadius * $c; //Distancia en kilómetros

    return $distance;
}
