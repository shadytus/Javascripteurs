<?php

require_once "../config/app.php";
require_once "../config/model.php";
require_once "../model/press.php";
require_once "../model/database.php";
require_once "../model/favorites.php";

session_start();

header('Content-Type: application/json');
echo json_encode([
    'articles' => press_get_articles(),
    'favoris' => array_keys(favorites_get())
]);