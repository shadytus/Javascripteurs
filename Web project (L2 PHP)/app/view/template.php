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

function html_login_profile(array $user): string
{
    $nom = htmlspecialchars($user['nom']);
    $role = htmlspecialchars($user['role']);
    return <<<HTML
    <div class="search-page" style="text-align: center;">
        <h3>Bienvenue, {$nom} !</h3>
        <p>Vous êtes actuellement connecté en tant que : <strong>{$role}</strong>.</p>
        <a href="index.php?page=logout" style="display: inline-block; background: var(--color-primary); color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-top: 10px;">Se déconnecter</a>
    </div>
    HTML;
}

function html_login_form(string $message = ''): string
{
    $error_html = $message ? "<div style='background: #ffcccc; color: #cc0000; padding: 10px; border-radius: 5px; margin-bottom: 15px;'>{$message}</div>" : "";
    return <<<HTML
    <div class="search-page">
        <h2>Connexion</h2>
        {$error_html}
        <form class="search-form" method="POST" action="index.php?page=login">
            <div class="search-row">
                <label>Login :</label>
                <input type="text" name="login" placeholder="Entrez votre identifiant" required>
            </div>
            
            <div class="search-row">
                <label>Mot de passe :</label>
                <input type="password" name="password" placeholder="Entrez votre mot de passe" required>
            </div>
            
            <button type="submit" class="search-submit" style="margin-top: 10px;">Se connecter</button>
        </form>
    </div>
    HTML;
}

function html_home(array $une, array $articles): string
{
    $title_une = htmlspecialchars($une['title_art']);
    $hook_une = htmlspecialchars($une['hook_art']);
    $cat_une = htmlspecialchars($une['name_cat'] ?? 'Général');
    $img_une = "./media/" . htmlspecialchars($une['image_art']);
    $id_une = (int)$une['id_art'];

    $sidebar_html = '';
    foreach ($articles as $art) {
        $title = htmlspecialchars($art['title_art']);
        $cat = htmlspecialchars($art['name_cat'] ?? 'Général');
        $img = "./media/" . htmlspecialchars($art['image_art']);
        $id = (int)$art['id_art'];
        $sidebar_html .= <<<HTML
            <div class="sidebar-item">
                <div class="text">
                    <h4><a href="index.php?page=article&id={$id}">{$title}</a></h4>
                    <span class="tag">{$cat}</span>
                </div>
                <img src="{$img}" alt="Miniature">
            </div>
HTML;
    }

    return <<<HTML
    <div class="container">
        <div class="breaking-news">
            <div class="text">
                <h2><a href="index.php?page=article&id={$id_une}">{$title_une}</a></h2>
                <p>{$hook_une}</p>
                <span class="tag">{$cat_une}</span>
            </div>
            <img src="{$img_une}" alt="Image à la une">
        </div>
        <div class="sidebar">
            {$sidebar_html}
        </div>
    </div>
HTML;
}

function html_article_detail(array $article): string
{
    $cat = htmlspecialchars($article['name_cat'] ?? 'Général');
    $title = htmlspecialchars($article['title_art']);
    $date = date('d/m/Y', strtotime($article['date_art']));
    $img = "./media/" . htmlspecialchars($article['image_art']);
    $reporter = htmlspecialchars($article['name_rep'] ?? 'Anonyme');
    $content = nl2br(htmlspecialchars($article['content_art']));

    return <<<HTML
    <article class="article-detail" style="max-width: 800px; margin: 0 auto; padding: 20px;">
        <span class="tag" style="background: yellow; color: black; padding: 5px;">{$cat}</span>
        <h1>{$title}</h1>
        <p><em>Publié le {$date}</em></p>
        <img src="{$img}" alt="Illustration" style="width: 100%; border-radius: 8px; margin: 20px 0;">
        <p><em>Reporteur : {$reporter}</em></p>
        <div class="contenu-texte" style="font-size: 1.1rem; line-height: 1.6;">
            <p>{$content}</p> 
        </div>
        <a href="index.php?page=press" style="display: inline-block; margin-top: 20px;">⬅ Retour aux articles</a>
    </article>
HTML;
}

function html_favorites(array $articles): string
{
    $count = count($articles);
    $list_html = '';
    foreach ($articles as $art) {
        $title = htmlspecialchars($art['title_art']);
        $hook = htmlspecialchars($art['hook_art']);
        $id = (int)$art['id_art'];
        $list_html .= <<<HTML
            <article class="article-card">
                <h3>{$title}</h3>
                <p>{$hook}</p>
                <form method="POST" action="index.php?page=favoris">
                    <input type="hidden" name="id" value="{$id}">
                    <button name="action" value="remove">❌ Retirer</button>
                </form>
            </article>
HTML;
    }

    return <<<HTML
    <div class="favorites-page">
        <h2>Mes favoris</h2>
        <p>Total : {$count} favori(s)</p>
        <form method="POST" action="index.php?page=favoris">
            <button name="action" value="clear">🗑️ Vider</button>
        </form>
        <div class="articles-list">
            {$list_html}
        </div>
    </div>
HTML;
}

function html_press_list(array $articles, array $favoris): string
{
    $list_html = '';
    foreach ($articles as $art) {
        $id = (int)$art['id_art'];
        $cat = htmlspecialchars($art['name_cat'] ?? 'Général');
        $title = htmlspecialchars($art['title_art']);
        $hook = htmlspecialchars($art['hook_art']);
        $img = "./media/" . htmlspecialchars($art['image_art']);
        
        $is_fav = isset($favoris[$id]);
        $btn_val = $is_fav ? 'remove' : 'add';
        $btn_txt = $is_fav ? '❌ Retirer' : '⭐ Ajouter aux favoris';

        $list_html .= <<<HTML
        <article class="article-card sidebar-item">
            <img src="{$img}" alt="Miniature">
            <div class="text">
                <span class="tag">{$cat}</span>
                <h3><a href="index.php?page=article&id={$id}">{$title}</a></h3>
                <p class="accroche">{$hook}</p>
                <a href="index.php?page=article&id={$id}">Lire la suite</a>
                <form method="POST" action="index.php?page=favoris">
                    <input type="hidden" name="id" value="{$id}">
                    <button name="action" value="{$btn_val}">{$btn_txt}</button>
                </form>
            </div>
        </article>
HTML;
    }

    return <<<HTML
    <div class="press-page">
        <h2>Tous les articles</h2>
        <div class='articles-list'>
            {$list_html}
        </div>
    </div>
HTML;
}

function html_search(string $keyword, string $author, array $articles): string
{
    $kw_val = htmlspecialchars($keyword);
    $author_val = htmlspecialchars($author);
    $results_html = '';

    if ($keyword !== '') {
        if (empty($articles)) {
            $results_html = "<p class='search-no-results'>Aucun résultat pour « <strong>{$kw_val}</strong> ».</p>";
        } else {
            $count = count($articles);
            $results_html = "<p class='search-count'>{$count} résultat(s) pour « <strong>{$kw_val}</strong> »</p>";
            $results_html .= "<div class='articles-list'>";
            foreach ($articles as $article) {
                $title = htmlspecialchars($article['title_art']);
                $hook = htmlspecialchars($article['hook_art']);
                $id = (int)$article['id_art'];
                $results_html .= <<<HTML
                <article class="article-card">
                    <h3>{$title}</h3>
                    <p class="accroche">{$hook}</p>
                    <a href="index.php?page=article&id={$id}">Lire la suite →</a>
                    <form method="POST" action="index.php?page=favoris">
                        <input type="hidden" name="id" value="{$id}">
                        <button name="action" value="add">⭐ Ajouter aux favoris</button>
                    </form>
                </article>
HTML;
            }
            $results_html .= "</div>";
        }
    }

    return <<<HTML
    <section class="search-page">
        <h2>🔍 Recherche d'articles</h2>
        <form class="search-form" method="GET" action="index.php">
            <input type="hidden" name="page" value="search">
            <div class="search-row">
                <label for="q">Mot-clé :</label>
                <input type="text" id="q" name="q" value="{$kw_val}" placeholder="Rechercher un titre ou un texte..." required>
            </div>
            <div class="search-row">
                <label for="author">Auteur (optionnel) :</label>
                <input type="text" id="author" name="author" value="{$author_val}" placeholder="Nom de l'auteur...">
            </div>
            <button type="submit" class="search-submit">Rechercher</button>
        </form>
        <div class="search-results">
            {$results_html}
        </div>
    </section>
HTML;
}

function html_static(array $content): string
{
    $features_html = '';
    foreach (($content['fonctionnalites'] ?? []) as $feature) {
        $features_html .= "<li>" . htmlspecialchars($feature) . "</li>\n";
    }

    $authors_html = '';
    foreach (($content['auteurs'] ?? []) as $author) {
        $nom = htmlspecialchars($author['nom']);
        $role = htmlspecialchars($author['role']);
        $authors_html .= "<li><strong>{$nom}</strong> — {$role}</li>\n";
    }

    return <<<HTML
    <section class="about-section">
        <h2>À propos de Javascripteurs</h2>
        <p>Ce projet est réalisé dans le cadre du Bachelor ISFCE</p>
        <p>Vous pouvez retrouver le code source sur <a href="https://github.com/shadytus/Javascripteurs" target="_blank">GitHub</a>.</p>
    </section>
    <section class="apropos">
        <h3>Fonctionnalités implantées</h3>
        <ul class="feature-list">
            {$features_html}
        </ul>
        <h3>Équipe</h3>
        <ul class="authors-list">
            {$authors_html}
        </ul>
        <h3>Technologies utilisées</h3>
        <ul class="tech-list">
            <li>PHP 8 (architecture MVC)</li>
            <li>MySQL / PDO</li>
            <li>HTML5 / CSS3</li>
            <li>Bootstrap 5</li>
            <li>Vue.js 3</li>
            <li>API externe Burotix (authentification &amp; bannières)</li>
        </ul>
    </section>
HTML;
}
