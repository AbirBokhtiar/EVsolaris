<?php
require_once('../model/userModel.php');
require_once('../model/db.php');
session_start();

$query = isset($_GET['query']) ? $_GET['query'] : '';
$cities = isset($_GET['city']) ? $_GET['city'] : [];

if ($query === '' && empty($cities)) {
    $stations = getAllStations();
} elseif (!empty($cities)) {
    $stations = [];
    foreach ($cities as $city) {
        $stations = array_merge($stations, searchStationByCityMultiple($city));
    }
} else {
    $stations = searchByStations($query);
}

foreach ($stations as $station) {
    echo '<div class="grid-card">';
    echo '<img src="https://placehold.co/250x150" alt="Station Image">';
    echo '<a href="slot_booking.php?station_name=' . urlencode($station['st_name']) . '" style="text-decoration: none; color: black;">';
    echo '<h2>' . htmlspecialchars($station['st_name']) . '</h2>';
    echo '</a>';
    echo '<p>' . htmlspecialchars($station['st_address']) . '</p>';
    echo '</div>';
}
?>
