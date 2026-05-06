<?php
function main_search(): string
{
    $menu_a  = get_menu();
    $keyword = trim($_GET['q']      ?? '');
    $author  = trim($_GET['author'] ?? '');
    $user    = $_SESSION['user'] ?? null;
    $banner  = get_banner_html();

    $articles = [];
    if ($keyword !== '') {
        $articles = search_articles($keyword, $author, 20);
    }

    $content = html_search($keyword, $author, $articles);

    return html_head($menu_a, $user, 'search') . $content . html_foot($banner);
}
