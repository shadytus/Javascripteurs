<?php
function html_head(array $menu_a): string
{
    $user_html = isset($_SESSION['user'])
        ? "👤 <strong>{$_SESSION['user']['nom']}</strong> | <a href='index.php?page=logout'>Déconnexion</a>"
        : "👤 <a href='index.php?page=login'>Non identifié</a>";

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
        <link rel="stylesheet" href="lib/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="lib/fontawesome/all.min.css">
        <link rel="stylesheet" href="./public/css/main.css"> 
    </head>
    <body>
        
    <header class="jn-header">
        <div class="header-top">
            <div class="header-left">
                <h1>📰 Javascripteurs</h1>
                <nav>
                    {$menu_html}
                </nav>
            </div>
            
            <div class="header-right">
                <nav>
                    {$user_html}
                </nav>
            </div>
            
            <div class="nav-actions">
                <button id="toggle-articles">Masquer articles</button>
            </div>
        </div>
    </header>

    <main>
    HTML;
}

function html_foot(): string
{
    $banner = '';
    $url    = 'http://playground.burotix.be/adv/banner_for_isfce.json';
    $result = @file_get_contents($url);
    if ($result) {
        $data   = json_decode($result, true);
        $text   = htmlspecialchars($data['text']  ?? '');
        $image  = htmlspecialchars($data['image'] ?? '');
        $color  = htmlspecialchars($data['color'] ?? '#f0f0f0');
        $banner = <<<HTML
        <aside class="banner" style="background-color:{$color};">
            <img src="{$image}" alt="Sponsor">
            <p>{$text}</p>
        </aside>
        HTML;
    }

    return <<<HTML
    </main>
    {$banner}
    <footer>
        <p>© 2025 Javascripteurs</p>
    </footer>
    </body>
    </html>
    HTML;
}
