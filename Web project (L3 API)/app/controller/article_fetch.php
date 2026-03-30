<?php

require_once "../config/app.php";
require_once "../config/model.php";
require_once "../model/database.php";
require_once "../model/press.php";

header('Content-Type: application/json');
if (!isset($_GET['id'])) {
    echo json_encode("inconnu"); 
    exit; // On stoppe l'exécution AVANT d'appeler la fonction SQL
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$mode = $_GET['mode'] ?? 'full'; // 'light' ou  'full'

$article = press_get_article_by_id($id);

$wordCount = str_word_count(strip_tags($article['content_art'] ?? ''));

if ($mode === 'light') {
    // On ne renvoie que les champs essentiels pour la liste
    echo json_encode([
        'id' => $article['ident_art'],
        'date' => $article['date_art'],
        'readtime' => $article['readtime_art'],
        'category' => $article['name_cat'],
        'wordCount' => $wordCount
    ]);
    exit;
}
else {
    // On peut aussi ajouter un champ de résumé pour le mode "full"
    $article['wordCount'] = $wordCount;
    $article['readtime'] = $article['readtime_art'];    
    echo json_encode($article);
    exit;
}


http_response_code(400);
echo json_encode(['error' => 'ID invalide ou article non trouvé']);



