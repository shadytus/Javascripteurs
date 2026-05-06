<?php

function main_list_articles_fetch(): string
{
    header('Content-Type: application/json');
    return json_encode([
        'articles' => press_get_articles(),
        'favoris' => array_keys(favorites_get($_SESSION['favoris'] ?? []))
    ]);
}