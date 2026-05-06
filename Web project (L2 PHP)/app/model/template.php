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

function get_banner_html(): string
{
    $url    = 'http://playground.burotix.be/adv/banner_for_isfce.json';
    $result = @file_get_contents($url);
    if ($result) {
        $data   = json_decode($result, true);
        $text   = htmlspecialchars($data['text']  ?? '');
        $image  = htmlspecialchars($data['image'] ?? '');
        return <<<HTML
        <aside class="banner">
            <img src="{$image}" alt="Sponsor (me)">
            <p>{$text}</p>
        </aside>
        HTML;
    }
    return '';
}
