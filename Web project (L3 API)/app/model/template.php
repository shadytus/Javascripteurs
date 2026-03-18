<?php
function get_menu(): array
{
    return [
        ['label' => 'Accueil',    'page' => 'home'],
        ['label' => 'Articles',   'page' => 'press'],
        ['label' => 'Recherche',  'page' => 'search'],
        ['label' => 'Favoris',    'page' => 'favoris'],
        ['label' => 'Login',      'page' => 'login'],
        ['label' => 'À propos',   'page' => 'static'],
    ];
}
