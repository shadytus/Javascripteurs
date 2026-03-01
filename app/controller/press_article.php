<?php
function main_article(): string {
    $menu_a = get_menu();
    
    // 1. On récupère l'ID dans l'URL (s'il n'y en a pas, on met 0 par défaut)
    $id = $_GET['id'] ?? 0;
    
    // 2. On interroge le Modèle
    $article = press_get_article_by_id((int)$id);

    // 3. Sécurité : Si l'article n'existe pas
    if (!$article) {
        return join("\n", [
            html_head($menu_a),
            "<h2>Erreur</h2><p>Cet article n'existe pas ou a été supprimé.</p>",
            html_foot()
        ]);
    }

    // 4. On prépare l'affichage
    $chemin_img = "./media/" . $article['image_art'];
    $date_formattee = date('d/m/Y', strtotime($article['date_art']));
    $reporter = htmlspecialchars($article['name_rep'] ?? 'Anonyme');
    
    $html = <<<HTML
    <article class="article-detail" style="max-width: 800px; margin: 0 auto; padding: 20px;">
        <span class="tag" style="background: yellow; color: black; padding: 5px;">{$article['name_cat']}</span>
        <h1>{$article['title_art']}</h1>
        <p><em>Publié le {$date_formattee}</em></p>
        
        <img src="{$chemin_img}" alt="Illustration" style="width: 100%; border-radius: 8px; margin: 20px 0;">
        <p><em>Reporteur : {$reporter}</em></p>

        <div class="contenu-texte" style="font-size: 1.1rem; line-height: 1.6;">
            <p>{$article['content_art']}</p> 
        </div>
        
        <a href="index.php?page=press" style="display: inline-block; margin-top: 20px;">⬅ Retour aux articles</a>
    </article>
    HTML;

    return join("\n", [
        html_head($menu_a),
        $html,
        html_foot()
    ]);
}