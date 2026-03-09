<?php
function main_search(): string
{
    $menu_a  = get_menu();
    $keyword = trim($_GET['q']      ?? '');
    $author  = trim($_GET['author'] ?? '');
    $results_html = '';

    if ($keyword !== '') {
        $articles = search_articles($keyword, $author, 20);

        if (empty($articles)) {
            $kw_safe  = htmlspecialchars($keyword);
            $results_html = "<p class='search-no-results'>Aucun résultat pour « <strong>{$kw_safe}</strong> ».</p>";
        } else {
            $count = count($articles);
            $kw_safe = htmlspecialchars($keyword);
            $results_html = "<p class='search-count'>{$count} résultat(s) pour « <strong>{$kw_safe}</strong> »</p>";
            $results_html .= "<div class='articles-list'>";
            foreach ($articles as $article) {
                $title   = htmlspecialchars($article['title_art']  ?? '');
                $accroche = htmlspecialchars($article['hook_art']  ?? '');
                $id      = (int)($article['id_art'] ?? 0);
                $results_html .= <<<HTML
                <article class="article-card">
                    <h3>{$title}</h3>
                    <p class="accroche">{$accroche}</p>
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

    $kw_val     = htmlspecialchars($keyword);
    $author_val = htmlspecialchars($author);

    $html = <<<HTML
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

    return join("\n", [
        html_head($menu_a),
        $html,
        html_foot(),
    ]);
}
