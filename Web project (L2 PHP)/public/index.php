<?php
require_once "../app/config/app.php";
require_once "../app/config/model.php";

function include_mvc_php_files(): void
{
    foreach (['model', 'view', 'controller'] as $dir) {
        $file_a = scandir(ROOT_DIR . $dir);
        foreach ($file_a as $file) {
            if (substr($file, -4, 4) != ".php") continue;
            require_once(ROOT_DIR.$dir.DIRECTORY_SEPARATOR.$file);
        }
    }
}

session_start();
include_mvc_php_files();

$page = @$_REQUEST['page'] ?: 'home';
$main = "main_{$page}";

if (function_exists($main)) {
    echo $main();
} else {
    echo main_home();
}
