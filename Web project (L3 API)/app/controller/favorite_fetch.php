<?php

// Initialisation du tableau de favoris en session si inexistant 
if (!isset($_SESSION['favoris'])) {
    $_SESSION['favoris'] = [];
}

$id = $_GET['id'] ?? null;
$action = $_GET['action'] ?? ''; // 'add', 'remove', ou 'clear'

if ($action === 'clear') {
    favorites_clear();
}
elseif ($id) {
    if ($action === 'add' && !in_array($id, $_SESSION['favoris'])) {
        favorites_add($id);
    } 
elseif ($action === 'remove' && in_array($id, $_SESSION['favoris'])) {
        favorites_remove($id);
}
}

// On récupère les titres pour l'affichage dynamique (max 5) 
// Note : Tu devras utiliser ton Model ici pour transformer les IDs en titres
$titres = []; 
foreach (array_slice($_SESSION['favoris'], -5) as $favId) {
     $titres[] = $favId['title_art'] ?? "Article #$favId"; // Remplace par la vraie récupération du titre
}

header('Content-Type: application/json');
echo json_encode([
    'count' => count($_SESSION['favoris']),
    'titles' => $titres
]);