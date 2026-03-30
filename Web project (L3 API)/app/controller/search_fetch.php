<?php
// On désactive l'affichage des erreurs à l'écran pour ne pas polluer le JSON
error_reporting(0);
ini_set('display_errors', 0);

require_once "../config/app.php";
require_once "../model/database.php";
//require_once "../model/search.php";
require_once "../model/press.php";

session_start();




header('Content-Type: application/json');

$q = $_GET['q'] ?? '';
$author = $_GET['author'] ?? '';




// On nettoie les entrées
$keyword = trim($q);
$authName = trim($author);

 

echo "Requête reçue : keyword='$keyword', author='$authName'";


// Appel de ta fonction de recherche
// Assure-toi que cette fonction retourne bien un array (même vide)
$articles = search_articles($keyword, $authName, 20); 


if (empty($articles)) {
    echo json_encode("inconnu"); // Ce que ton JS attend 
} else {
    echo json_encode($articles); // Le tableau d'articles
}
exit;