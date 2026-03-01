<?php
function main_static(): string
{
    $menu_a  = get_menu();
    $content = get_static_content('apropos');

    // Fonctionnalités
    $features_html = '';
    foreach (($content['fonctionnalites'] ?? []) as $feature) {
        $features_html .= "<li>{$feature}</li>\n";
    }

    // Auteurs
    $authors_html = '';
    foreach (($content['auteurs'] ?? []) as $author) {
        $authors_html .= "<li><strong>{$author['nom']}</strong> — {$author['role']}</li>\n";
    }

    $titre       = htmlspecialchars($content['titre']       ?? 'À propos');
    $description = htmlspecialchars($content['description'] ?? '');

    $html = <<<HTML
    <section class="apropos">
        <h2>{$titre}</h2>
        <p class="apropos-description">{$description}</p>

        <h3>Fonctionnalités implantées</h3>
        <ul class="feature-list">
            {$features_html}
        </ul>

        <h3>Équipe</h3>
        <ul class="authors-list">
            {$authors_html}
        </ul>

        <h3>Technologies utilisées</h3>
        <ul class="tech-list">
            <li>PHP 8 (architecture MVC)</li>
            <li>MySQL / PDO</li>
            <li>HTML5 / CSS3</li>
            <li>Bootstrap 5</li>
            <li>Vue.js 3</li>
            <li>API externe Burotix (authentification &amp; bannières)</li>
        </ul>
    </section>
    HTML;

    return join("\n", [
        html_head($menu_a),
        $html,
        html_foot(),
    ]);
}
