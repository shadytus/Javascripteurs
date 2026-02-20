<?php
require_once "../app/config/app.php";
require_once "../app/model/favorites.php";
require_once "../app/controller/favoris.php";
require_once "../app/controller/login.php";

function include_mvc_php_files()
{
@@ -19,5 +22,7 @@ function include_mvc_php_files()

$page = @$_REQUEST['page'] ?: 'home';
$main = "main_{$page}";
$favoris = "main_{favoris}";
$login = "main_{login}";
$logout = "main_{logout}";
echo $main();
