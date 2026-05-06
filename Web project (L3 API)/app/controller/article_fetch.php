<?php

function main_article_fetch(): string
{
    header('Content-Type: application/json');
    if (!isset($_GET['id'])) {
        return json_encode("inconnu"); 
    }

    $id = (int)$_GET['id'];
    $mode = $_GET['mode'] ?? 'full';

    $article = press_get_article_by_id($id);
    if (!$article) {
        http_response_code(404);
        return json_encode(['error' => 'Article non trouvé']);
    }

    $wordCount = str_word_count(strip_tags($article['content_art'] ?? ''));

    if ($mode === 'light') {
        return json_encode([
            'id' => $article['id_art'],
            'date' => $article['date_art'],
            'readtime' => $article['readtime_art'] ?? 0,
            'category' => $article['name_cat'],
            'wordCount' => $wordCount
        ]);
    } else {
        $article['wordCount'] = $wordCount;
        $article['readtime'] = $article['readtime_art'] ?? 0;    
        return json_encode($article);
    }
}



