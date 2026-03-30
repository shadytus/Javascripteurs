<?php

// L'ordre est important : database d'abord !
require_once "../config/app.php";
require_once "../config/model.php";
require_once "../model/database.php";
require_once "../model/press.php";
require_once "../model/favorites.php";

session_start();
header('Content-Type: application/json');

$action = $_GET['action'] ?? 'list'; // 'list' par défaut au démarrage
$id     = isset($_GET['id']) ? (int)$_GET['id'] : null; // On récupère l'ID !

// 1. Exécuter l'action demandée
if ($action === 'clear') {
    favorites_clear();
} elseif ($id) {
    if ($action === 'add') {
        favorites_add($id);
    } elseif ($action === 'remove') {
        favorites_remove($id);
    }
}

// 2. Récupérer les IDs à jour
$ids = array_keys($_SESSION['favoris'] ?? []);

// 3. Renvoyer la réponse propre
if (empty($ids)) {
    echo json_encode(['count' => 0, 'articles' => []]);
    exit;
}

// ICI, il faudra idéalement récupérer les VRAIS articles depuis la DB avec ces $ids
$articles = [];
foreach ($ids as $id) {
    $article = press_get_article_by_id($id);
    if ($article) {
        $articles[] = $article;
    }

}


// Pour l'instant, on renvoie juste les IDs pour que le JS ne plante pas.
echo json_encode([
    'count' => count($ids),
    'articles' => $articles // On changera ça à l'étape suivante !
]);
exit;