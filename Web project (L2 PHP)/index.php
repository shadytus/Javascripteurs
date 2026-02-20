<?php
require_once "../app/config/app.php";
require_once "../app/model/favorites.php";
require_once "../app/controller/favoris.php";
require_once "../app/controller/login.php";

function include_mvc_php_files()
{
    foreach ( array('model', 'view', 'controller') as $dir )
    {
        $file_a = scandir(ROOT_DIR.$dir);
        foreach ( $file_a as $file )
        {
            if( substr($file, -4, 4) != ".php" ) continue;
            require_once( ROOT_DIR.$dir.DIRECTORY_SEPARATOR.$file );
        }
    }
}

session_start();
include_mvc_php_files();

$page = @$_REQUEST['page'] ?: 'home';
$main = "main_{$page}";
$favoris = "main_{favoris}";
$login = "main_{login}";
$logout = "main_{logout}";
echo $main();
