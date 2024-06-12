<?php

header('Content-Type: application/json');

$data = file_get_contents("countryBorders.geo.json");
$json_data = json_decode($data, true);


if (isset($_POST['countryCode'])) {
    $isoCode = $_POST['countryCode'];
    foreach ($json_data['features'] as $feature) {
        if ($feature['properties']['iso_a2'] === $isoCode) {
            echo json_encode($feature);
            exit;
        }
    }
    echo json_encode(["error" => "Country border not found."]);
} else {
    $countries = [];
    foreach ($json_data['features'] as $feature) {
        $isoCode = $feature['properties']['iso_a2'];
        $countryName = $feature['properties']['name'];
        $countries[] = ['countryCode' => $isoCode, 'countryName' => $countryName];
    }
    echo json_encode($countries);
}
