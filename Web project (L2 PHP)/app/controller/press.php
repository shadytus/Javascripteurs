<?php
function main_press(): string
{
    $menu_a = get_menu();
    $articles = press_get_articles();
    $user = $_SESSION['user'] ?? null;
    $banner = get_banner_html();
    $favoris = favorites_get($_SESSION['favoris'] ?? []);

    $content = html_press_list($articles, $favoris);

    return html_head($menu_a, $user, 'press') . $content . html_foot($banner);
}
