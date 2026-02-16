<?php
function main_search(): string
{
    $menu_a   = get_menu();
    $keyword  = @$_REQUEST['keyword'] ?? '';
    $author   = @$_REQUEST['author'] ?? '';
    $limit    = @$_REQUEST['limit'] ?? 10;
    $results  = [];

    if (!empty($keyword) || !empty($author)) {
        $results = search_articles($keyword, $author, (int)$limit);
    }

    // Formulaire de recherche
    $form = <<<HTML
    <section class="search-form">
        <h2>Recherche d'articles</h2>
        <form method="GET" action="index.php">
            <input type="hidden" name="page" value="search">
            
            <label>Mot-clé dans le titre :</label>
            <input type="text" name="keyword" value="{$keyword}" placeholder="Ex: sport, monde...">
            
            <label>Auteur :</label>
            <select name="author">
                <option value="">-- Tous les auteurs --</option>
            </select>
            
            <label>Nombre max d'articles :</label>
            <select name="limit">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="20">20</option>
            </select>
            
            <button type="submit">🔍 Rechercher</button>
        </form>
    </section>
    HTML;

    // Résultats
    $results_html = '';
    if (!empty($results)) {
        $results_html .= "<h3>" . count($results) . " article(s) trouvé(s)</h3>";
        foreach ($results as $article) {
            $results_html .= <<<HTML
            <article class="article-card">
                <h4>{$article['title_art']}</h4>
                <p>{$article['accroche_art']}</p>
                <a href="index.php?page=article&id={$article['id_art']}">Lire</a>
            </article>
            HTML;
        }
    } elseif (!empty($keyword)) {
        $results_html = "<p>Aucun article trouvé pour : <strong>{$keyword}</strong></p>";
    }

    return join("\n", [
        html_head($menu_a),
        $form,
        "<div class='search-results'>{$results_html}</div>",
        html_foot(),
    ]);
}

