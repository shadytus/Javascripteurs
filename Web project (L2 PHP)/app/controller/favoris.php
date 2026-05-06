<?php
function main_favoris(): string
{
    $menu_a = get_menu();
    $action = $_POST['action'] ?? '';
    $id     = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $user   = $_SESSION['user'] ?? null;
    $banner = get_banner_html();

    if (!isset($_SESSION['favoris'])) $_SESSION['favoris'] = [];

    if ($action === 'add'    && $id > 0) favorites_add($_SESSION['favoris'], $id);
    if ($action === 'remove' && $id > 0) favorites_remove($_SESSION['favoris'], $id);
    if ($action === 'clear')             favorites_clear($_SESSION['favoris']);

    if (!empty($action)) {
        $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
        header("Location: " . $referer);
        exit;
    }

    $ids = favorites_get($_SESSION['favoris']);
    $articles = [];
    foreach ($ids as $fav_id) {
        $art = press_get_article_by_id($fav_id);
        if ($art) $articles[] = $art;
    }

    $content = html_favorites($articles);

    return html_head($menu_a, $user, 'favoris') . $content . html_foot($banner);
}
