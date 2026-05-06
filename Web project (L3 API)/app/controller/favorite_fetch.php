<?php

function main_favorite_fetch(): string
{
    header('Content-Type: application/json');

    $action = $_GET['action'] ?? 'list';
    $id     = isset($_GET['id']) ? (int)$_GET['id'] : null;

    if (!isset($_SESSION['favoris'])) $_SESSION['favoris'] = [];

    if ($action === 'clear') {
        favorites_clear($_SESSION['favoris']);
    } elseif ($id) {
        if ($action === 'add') {
            favorites_add($_SESSION['favoris'], $id);
        } elseif ($action === 'remove') {
            favorites_remove($_SESSION['favoris'], $id);
        }
    }

    $ids = array_keys($_SESSION['favoris']);

    if (empty($ids)) {
        return json_encode(['count' => 0, 'articles' => []]);
    }

    $articles = [];
    foreach ($ids as $fav_id) {
        $article = press_get_article_by_id($fav_id);
        if ($article) {
            $articles[] = $article;
        }
    }

    return json_encode([
        'count' => count($ids),
        'articles' => $articles
    ]);
}