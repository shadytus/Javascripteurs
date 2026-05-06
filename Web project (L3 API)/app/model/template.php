<?php
function get_menu(): array
{
    return [
        ['label' => 'Accueil',    'page' => 'home'],
        ['label' => 'Articles',   'page' => 'press'],
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
        $data = json_decode($result, true);
        if (isset($data['banner_4IPDW'])) {
            $adv = $data['banner_4IPDW'];
            $text    = htmlspecialchars($adv['text'] ?? '');
            $image   = htmlspecialchars($adv['image'] ?? '');
            $couleur = htmlspecialchars($adv['color'] ?? '#f8f9fa');
            $bg_img  = htmlspecialchars($adv['background_image'] ?? '');
            $link    = htmlspecialchars($adv['link'] ?? '#');
            return <<<HTML
            <aside class="banner-sponsor" style="background-color: {$couleur}; background-image: url('{$bg_img}');">
                <a href="{$link}" target="_blank" class="banner-link">
                    <img src="{$image}" alt="Burotix Sponsor" class="sponsor-img-main">
                    <div class="banner-content"><p>{$text}</p></div>
                </a>
            </aside>
HTML;
        }
    }
    return '';
}
