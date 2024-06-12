<?php

$executionStartTime = microtime(true) / 1000;

$result = file_get_contents('countryBorders.geo.json');

function compare($a, $b)
{

    if ($a["name"] == $b["name"]) return 0;

    return ($a["name"] < $b["name"]) ? -1 : 1;
}

$border = json_decode($result, true);
$countryInfo = json_decode($result, true);

$output['status']['code'] = "200";
$output['status']['name'] = "ok";
$output['status']['description'] = "success";
$output['status']['executedIn'] = intval((microtime(true) - $executionStartTime) * 1000) . " ms";

$output['data']['border'] = $border;
$output['data']['countryInfo'] = $countryInfo;

header('Content-Type: application/json; charset=UTF-8');

echo json_encode($output);
