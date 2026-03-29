<?php
function main_search(): string
{
    $keyword = trim($_GET['q']      ?? '');
    $author  = trim($_GET['author'] ?? '');

    if ($keyword === '') {
        echo json_encode([]);
        exit;
    }

    $articles = search_articles($keyword, $author, 20);

    if (empty($articles)) {
        echo json_encode("inconnu");
        exit;
    }
    else {
        echo json_encode($articles);
        exit;
    }
}
