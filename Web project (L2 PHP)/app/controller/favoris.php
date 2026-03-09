<?php
function main_favoris(): string
{
    $menu_a = get_menu();
    $action = $_POST['action'] ?? '';
    $id     = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($action === 'add'    && $id > 0) favorites_add($id);
    if ($action === 'remove' && $id > 0) favorites_remove($id);
    if ($action === 'clear')             favorites_clear();

    if (!empty($action)) {
        // On récupère l'URL de la page précédente, sinon on renvoie vers l'accueil par défaut
        $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
        header("Location: " . $referer);
        exit; // On arrête tout, on n'affiche pas le HTML ci-dessous
    }

    $ids  = favorites_get();
    $html = '<p>Total : ' . count($ids) . ' favori(s)</p>';
    $html .= '<form method="POST" action="index.php?page=favoris">
                <button name="action" value="clear">🗑️ Vider</button>
              </form>';
    
    $html .= '<div class="articles-list">';

    foreach ($ids as $id) {
        $article = press_get_article_by_id($id);
        if (!empty($article)) {
            $html .= <<<HTML
            <article class="article-card">
                <h3>{$article['title_art']}</h3>
                <p>{$article['hook_art']}</p>
                <form method="POST" action="index.php?page=favoris">
                    <input type="hidden" name="id" value="{$article['id_art']}">
                    <button name="action" value="remove">❌ Retirer</button>
                </form>
            </article>
            HTML;
        }
    }
    $html .= '</div>'; // Fin de la grille

    return join("\n", [html_head($menu_a), "<h2>Mes favoris</h2>$html", html_foot()]);
}
