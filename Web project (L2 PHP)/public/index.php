<?php
require_once "../app/config/app.php";

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
echo $main();
```
