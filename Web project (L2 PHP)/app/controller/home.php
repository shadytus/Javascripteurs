<?php
function main_home(): string
{
    $menu_a = get_menu();
    $articles = press_get_articles(); 
    $user = $_SESSION['user'] ?? null;
    $banner = get_banner_html();

    if (empty($articles)) {
        return html_head($menu_a, $user, 'home') . "<p>Aucun article trouvé.</p>" . html_foot($banner);
    }

    $une = array_shift($articles); 
    shuffle($articles);

    $content = html_home($une, $articles);

    return html_head($menu_a, $user, 'home') . $content . html_foot($banner);
}

