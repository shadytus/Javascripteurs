<?php
function html_head(array $menu_a, ?array $user, string $current_page): string
{
    $user_html = $user
        ? "👤 <strong>{$user['nom']}</strong> | <a href='index.php?page=logout'>Déconnexion</a>"
        : "👤 <a href='index.php?page=login'>Non identifié</a>";

    $menu_html = '';
    foreach ($menu_a as $item) {
        $active     = ($item['page'] === $current_page) ? " class='active'" : '';
        $menu_html .= "<a href='index.php?page={$item['page']}'{$active}>{$item['label']}</a>\n";
    }
    
    $is_admin = ($user && $user['role'] === 'admin') ? 'true' : 'false';

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


function html_foot(string $banner_html = ''): string
{
    return <<<HTML
    </main>
    {$banner_html}
    <footer>
        <p>© 2025 Javascripteurs</p>
    </footer>
    </body>
    </html>
    HTML;
}