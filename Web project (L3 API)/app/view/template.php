<?php
function html_head(array $menu_a): string
{
    $user_html = isset($_SESSION['user'])
        ? "👤 <strong>{$_SESSION['user']['nom']}</strong> | <a href='index.php?page=logout'>Déconnexion</a>"
        : "👤 <a href='index.php?page=login'>Non identifié</a>";

    $current_page = $_GET['page'] ?? 'home';
    $menu_html = '';
    foreach ($menu_a as $item) {
        $active     = ($item['page'] === $current_page) ? " class='active'" : '';
        $menu_html .= "<a href='index.php?page={$item['page']}'{$active}>{$item['label']}</a>\n";
    }
    
    $is_admin = (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') ? 'true' : 'false';

    return <<<HTML
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Javascripteurs - Site de presse</title>
        <link rel="stylesheet" href="lib/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="lib/fontawesome/all.min.css">
        <link rel="stylesheet" href="./css/main.css"> 
        <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
        <script type="module" src="./public/main.js"></script>
        <script>window.USER_ROLE_IS_ADMIN = {$is_admin};</script>
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
        $banner = <<<HTML
        <aside class="banner">
            <img src="{$image}" alt="Sponsor (me)">
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
