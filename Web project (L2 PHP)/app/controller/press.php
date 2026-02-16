<?php
function main_press(): string
{
    $menu_a = get_menu();
    $articles_a = press_get_articles();

    $html = '';
    foreach ($articles_a as $article) {
        $html .= <<<HTML
        <article class="article-card">
            <h3>{$article['title_art']}</h3>
            <p class="accroche">{$article['accroche_art']}</p>
            <a href="index.php?page=article&id={$article['id_art']}">Lire la suite</a>
            <button class="btn-favori" data-id="{$article['id_art']}">⭐ Favori</button>
        </article>
        HTML;
    }

    return join("\n", [
        html_head($menu_a),
        "<h2>Tous les articles</h2>",
        "<div class='articles-list'>{$html}</div>",
        html_foot(),
    ]);
}
