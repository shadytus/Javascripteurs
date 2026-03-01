<?php
function main_press(): string
{
    $menu_a = get_menu();
    $articles_a = press_get_articles();
    
    // 1. On récupère la liste des favoris AVANT de générer le HTML
    $mes_favoris = favorites_get(); 

    $html = '';
    
    // 2. On fait une seule boucle sur les articles
    foreach ($articles_a as $art) {
        $id_article = $art['id_art'];
        $categorie = htmlspecialchars($art['name_cat'] ?? 'Général');
        $chemin_img = "./media/" . $art['image_art']; 
        
        // 3. On détermine le bouton en fonction du statut de favori
        if (isset($mes_favoris[$id_article])) {
            $bouton_html = <<<HTML
            <form method="POST" action="index.php?page=favoris">
                <input type="hidden" name="id" value="{$id_article}">
                <button name="action" value="remove">❌ Retirer</button>
            </form>
            HTML;
        } else {
            $bouton_html = <<<HTML
            <form method="POST" action="index.php?page=favoris">
                <input type="hidden" name="id" value="{$id_article}">
                <button name="action" value="add">⭐ Ajouter aux favoris</button>
            </form>
            HTML;
        }

        // 4. On construit la carte unique avec toutes les infos et le bon bouton
        $html .= <<<HTML
        <article class="article-card sidebar-item">
            <img src="{$chemin_img}" alt="Miniature">
            <div class="text">
                <span class="tag">{$categorie}</span>
                <h3><a href="index.php?page=article&id={$id_article}">{$art['title_art']}</a></h3>
                <p class="accroche">{$art['hook_art']}</p>
                <a href="index.php?page=article&id={$id_article}">Lire la suite</a>
                {$bouton_html}
            </div>
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
