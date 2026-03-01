<?php
function get_static_content(string $name): array
{
    $path = ROOT_DIR . "../asset/static_content/{$name}.php";
    if (file_exists($path)) {
        return require $path;
    }
    return [];
}
