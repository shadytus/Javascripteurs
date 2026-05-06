
<?php
function main_static(): string {
    $menu_a = get_menu();
    $content = get_static_content('apropos');
    $user = $_SESSION['user'] ?? null;
    $banner = get_banner_html();

    $html = html_static($content);

    return html_head($menu_a, $user, 'static') . $html . html_foot($banner);
}

