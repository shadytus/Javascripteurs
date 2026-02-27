<?php
function main_static(): string
{
    $menu_a   = get_menu();
    $content  = get_static_content('apropos');

    $html = <<<HTML
    <section class="apropos">
        <h2>{$content['titre']}</h2>
        <p>{$content['description']}</p>

        <h3>Fonctionnalités implantées</h3>
        <ul>
    HTML;

    $html = <<<HTML
    <section class="apropos">
        <h2>{$content['titre']}</h2>
        <p>{$content['description']}</p>

        <h3>Fonctionnalités implantées</h3>
        <ul>
    HTML;
    
    return join("\n", [
        html_head($menu_a),
        $html,
        html_foot(),
    ]);
}
