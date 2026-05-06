<?php
function main_article(): string {
    $menu_a = get_menu();
    $id = (int)($_GET['id'] ?? 0);
    $article = press_get_article_by_id($id);
    $user = $_SESSION['user'] ?? null;
    $banner = get_banner_html();

    if (!$article) {
        return html_head($menu_a, $user, 'article') . "<h2>Erreur</h2><p>Cet article n'existe pas ou a été supprimé.</p>" . html_foot($banner);
    }

    $content = html_article_detail($article);

    return html_head($menu_a, $user, 'article') . $content . html_foot($banner);
}