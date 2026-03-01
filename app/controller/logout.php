<?php
function main_logout(): string
{
    // 1. Nettoyage : on supprime le fichier JSON temporaire
    $path = '/tmp/session_' . session_id() . '.json';
    if (file_exists($path)) unlink($path);

    // 2. On vide la session utilisateur
    unset($_SESSION['user']);

    // 3. LA REDIRECTION MAGIQUE
    // On regarde sur quelle page l'utilisateur était avant de cliquer sur "Déconnexion".
    // S'il n'y a pas d'historique (très rare), on le renvoie vers l'accueil par sécurité.
    $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php?page=home';
    
    header("Location: " . $referer);
    exit;
}