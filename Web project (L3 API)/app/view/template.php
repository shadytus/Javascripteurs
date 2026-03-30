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
        <!-- <link rel="stylesheet" href="lib/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="lib/fontawesome/all.min.css"> -->
        <link rel="stylesheet" href="./css/main.css"> 
        <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
        <script type="module" src="App.js"></script>
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
    $result = @file_get_contents($url); // On remet le @ pour la propreté
    
    if ($result) {
        $data = json_decode($result, true);
        
        // 1. On ouvre le fameux "tiroir" caché par le prof
        if (isset($data['banner_4IPDW'])) {
            $adv = $data['banner_4IPDW'];
            
            // 2. On extrait les vraies variables
            $text    = htmlspecialchars($adv['text'] ?? '');
            $image   = htmlspecialchars($adv['image'] ?? '');
            $couleur = htmlspecialchars($adv['color'] ?? '#f8f9fa');
            $bg_img  = htmlspecialchars($adv['background_image'] ?? '');
            $link    = htmlspecialchars($adv['link'] ?? '#');
            
            // 3. On génère le HTML en utilisant TOUTES les données demandées
            $banner = <<<HTML
            <aside class="banner-sponsor" style="
                background-color: {$couleur}; 
                background-image: url('{$bg_img}');
            ">
                <a href="{$link}" target="_blank" class="banner-link">
                    <img src="{$image}" alt="Burotix Sponsor" class="sponsor-img-main">
                    <div class="banner-content">
                        <p>{$text}</p>
                    </div>
                </a>
            </aside>
            HTML;
        }
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