<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
// basis url
$overpass_url = "http://overpass-api.de/api/interpreter?data=";

$data = $_GET["data"]; // The string with the query
$bbox = $_GET["bbox"]; // The bounding box (bbox) replaces the above string
$data = str_replace( "\\" , "" , $data); // Remove the double slash from the query string
$data = urlencode($data); // Form the correct request
$bbox = urlencode($bbox);
$request = $overpass_url.$data."&bbox=".$bbox;

$proxy = curl_init($request);
curl_setopt($proxy, CURLOPT_RETURNTRANSFER, 1);
header('Content-type: application/osm3s+xml');	// This is a special header for osm-xml
$response = curl_exec($proxy); // Send the query to overpass
print $response; // and the result to the client
curl_close($proxy);
?>
