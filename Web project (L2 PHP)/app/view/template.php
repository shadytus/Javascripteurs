<?php
function html_head($user_html = isset($_SESSION['user'])
    ? "👤 Bonjour <strong>{$_SESSION['user']['nom']}</strong> | <a href='index.php?page=logout'>Déconnexion</a>"
    : "👤 <a href='index.php?page=login'>Non identifié</a>";): string
{
    $menu_html = '';
    foreach ($menu_a as $item) {
        $menu_html .= "<a href='index.php?page={$item['page']}'>{$item['label']}</a>\n";
    }

    return <<<HTML
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Javascripteurs - Site de presse</title>
        <link rel="stylesheet" href="./css/main.css">
    </head>
    <body>
    <header>
        <h1>📰 Javascripteurs</h1>
        <div id="user-info">{$user_html}</div>
        <div id="mouse-coords">🖱️ x: 0, y: 0</div>
        <button id="toggle-articles">Masquer articles</button>
    </header>
    <nav>
        {$menu_html}
    </nav>
    <main>
    HTML;
}

function html_foot(): string
{
    return <<<HTML
    </main>
     $banner = '';
     $url    = 'http://playground.burotix.be/adv/banner_for_isfce.json';
    $result = @file_get_contents($url);
    if ($result) {
        $data   = json_decode($result, true);
        $text   = htmlspecialchars($data['text']   ?? '');
        $image  = htmlspecialchars($data['image']  ?? '');
        $color  = htmlspecialchars($data['color']  ?? '#f0f0f0');
        $image2 = htmlspecialchars($data['image2'] ?? '');
        $banner = <<<HTML
        <aside class="banner" style="background-color:{$color};">
            <img src="{$image}" alt="Sponsor">
            <p>{$text}</p>
            <img src="{$image2}" alt="Sponsor 2">
        </aside>
        HTML;
    }
    <footer>
        <p>© 2025 Javascripteurs - Projet L2 PHP</p>
    </footer>
    <script src="./js/main.js"></script>
    </body>
    </html>
    HTML;
}
function get_banner(): string
{
    $url  = 'http://playground.burotix.be/adv/banner_for_isfce.json';
    $json = @file_get_contents($url);
    if (!$json) return '';

    $data = json_decode($json, true);
    $text  = htmlspecialchars($data['text']  ?? '');
    $image = htmlspecialchars($data['image'] ?? '');
    $color = htmlspecialchars($data['color'] ?? '#f0f0f0');

    return <<<HTML
    <aside class="banner" style="background-color:{$color}">
        <img src="{$image}" alt="Publicité">
        <p>{$text}</p>
    </aside>
    HTML;
}

function html_body(): string
{
    return '';
}
