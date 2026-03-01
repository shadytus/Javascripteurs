<?php
function main_search(): string {
    $menu_a = get_menu();
    
    // 1. On récupère ce que l'utilisateur a tapé (s'il a tapé quelque chose)
    $mot_cle = $_GET['q'] ?? '';
    $resultats_html = '';

    // 2. Si on a un mot-clé, on demande au Modèle de chercher
    if (!empty($mot_cle)) {
        $articles = search_articles($mot_cle);
        
        if (count($articles) > 0) {
            foreach ($articles as $art) {
                // On recycle ta structure d'article
                $resultats_html .= <<<HTML
                <article class="article-card">
                    <h3>{$art['title_art']}</h3>
                    <p>{$art['hook_art']}</p>
                    <a href="index.php?page=article&id={$art['id_art']}">Lire</a>
                </article>
                HTML;
            }
        } else {
            $resultats_html = "<p>Aucun article trouvé pour '<b>" . htmlspecialchars($mot_cle) . "</b>'.</p>";
        }
    }

    // 3. On construit la page (Formulaire + Résultats)
    $html_page = <<<HTML
    <h2>Recherche</h2>
    <form method="GET" action="index.php" class="search-form">
        <input type="hidden" name="page" value="search">
        <input type="text" name="q" value="" placeholder="Chercher un article...">
        <button type="submit">🔍 Chercher</button>
    </form>
    <div class="articles-list">
        {$resultats_html}
    </div>
HTML;

    // 4. On assemble le sandwich (Template)
    return join("\n", [
        html_head($menu_a),
        $html_page,
        html_foot()
    ]);
}