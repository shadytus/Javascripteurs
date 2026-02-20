<?php
function main_category(): string
{
    $menu_a = get_menu();
    $id_cat = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($id_cat > 0) {
        // Afficher les articles d'une catégorie
        $articles_a = press_get_articles_by_category($id_cat);
        $html = '';
        foreach ($articles_a as $article) {
            $html .= <<<HTML
            <article class="article-card">
                <h3>{$article['title_art']}</h3>
                <p>{$article['accroche_art']}</p>
                <a href="index.php?page=article&id={$article['id_art']}">Lire la suite</a>
            </article>
            HTML;
        }
        return join("\n", [html_head($menu_a), "<h2>Articles</h2><div class='articles-list'>$html</div>", html_foot()]);
    }

    // Afficher toutes les catégories
    $categories_a = press_get_categories();
    $html = '<ul class="category-list">';
    foreach ($categories_a as $cat) {
        $html .= "<li><a href='index.php?page=category&id={$cat['id_cat']}'>{$cat['name_cat']}</a></li>";
    }
    $html .= '</ul>';

    return join("\n", [html_head($menu_a), "<h2>Catégories</h2>$html", html_foot()]);
}
