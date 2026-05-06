<?php
function main_search_fetch(): string
{
    header('Content-Type: application/json');

    $q = $_GET['q'] ?? '';
    $author = $_GET['author'] ?? '';

    $keyword = trim($q);
    $authName = trim($author);

    $articles = search_articles($keyword, $authName, 20); 

    if (empty($articles)) {
        return json_encode("inconnu");
    } else {
        return json_encode($articles);
    }
}