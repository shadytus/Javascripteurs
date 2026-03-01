<?php
function main_home(): string
{
    $menu_a = get_menu();
    
    $articles = press_get_articles(); 

    // Sécurité : s'il n'y a pas d'articles, on affiche un message
    if (empty($articles)) {
        return html_head($menu_a) . "<p>Aucun article trouvé.</p>" . html_foot();
    }


    // 1. EXTRAIRE L'ARTICLE A LA UNE
    // array_shift enlève le premier article du tableau et le stocke dans $une
    $une = array_shift($articles); 

    // On prépare le HTML de l'article principal (Breaking News)
    $categorie_une = htmlspecialchars($une['name_cat'] ?? 'Général'); // On remplace "Sport" par la vraie catégorie
    
    $chemin_une = "./public/media/" . $une['image_art'];

    $html = <<<HTML
    <div class="container">
        <div class="breaking-news">
            <img src="{$une['image_art']}" alt="Image à la une">
            <div class="text">
                <span class="tag">{$categorie_une}</span>
                <h2><a href="index.php?page=article&id={$une['id_art']}">{$une['title_art']}</a></h2>
                <p>{$une['hook_art']}</p>
            </div>
        </div>
        
        <div class="sidebar">
    HTML;


    // 2. BOUCLER SUR LE RESTE DES ARTICLES
    // $articles ne contient plus le premier article, donc on boucle sur les suivants

    shuffle($articles); // On mélange les articles pour varier les suggestions

    foreach ($articles as $art) {
        $categorie = htmlspecialchars($art['name_cat'] ?? 'Général');

        $chemin_img = "./public/media/" . $art['image_art']; 
        
        $html .= <<<HTML
            <div class="sidebar-item">
                <img src="{$chemin_img}" alt="Miniature">
                <div class="text">
                    <span class="tag">{$categorie}</span>
                    <h4><a href="index.php?page=article&id={$art['id_art']}">{$art['title_art']}</a></h4>
                </div>
            </div>
        HTML;
    }


    // On ferme la sidebar et le container
    $html .= <<<HTML
        </div> </div> 
    HTML;



    // 3. On assemble la page
    return join("\n", [
        html_head($menu_a),
        $html,
        html_foot()
    ]);
}

