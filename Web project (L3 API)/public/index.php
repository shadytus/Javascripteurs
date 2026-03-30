<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "../app/config/app.php";
require_once "../app/config/model.php";

function include_mvc_php_files(): void
{
    foreach (['model', 'view', 'controller'] as $dir) {
        $file_a = scandir(ROOT_DIR . $dir);
        foreach ($file_a as $file) {
            if (substr($file, -4, 4) != ".php") continue;
            if (str_contains($file, '_fetch.php')) continue;
            require_once(ROOT_DIR.$dir.DIRECTORY_SEPARATOR.$file);
        }
    }
}
if (isset($_GET['page']) && $_GET['page'] === 'logout') {
    // 1. On vide la session
    unset($_SESSION['user']);
    
    // 2. On redirige proprement vers la page login
    header('Location: index.php?page=home');
    exit;
}

session_start();
include_mvc_php_files();

if (isset($_POST['theme']))  $_SESSION['theme']  = $_POST['theme'];
if (isset($_POST['police'])) $_SESSION['police'] = $_POST['police'];

$page = @$_REQUEST['page'] ?: 'home';
//$main = "main_{$page}";

$vue_pages = ['press', 'article', 'search', 'favoris', 'login'];

if (in_array($page, $vue_pages)) {
    echo main_press();
} else {
    $main = "main_{$page}";
    echo function_exists($main) ? $main() : main_home();
}



// if (function_exists($main)) {
//     echo $main();
// } else {
//     echo main_home();
// }
