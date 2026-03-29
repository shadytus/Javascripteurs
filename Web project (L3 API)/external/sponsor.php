<?php
$url = "http://playground.burotix.be/adv/banner_for_isfce.json";
$json_data = file_get_contents($url);

$data = json_decode($json_data, true);

?>
