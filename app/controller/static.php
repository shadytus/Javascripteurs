
<?php
function main_static(): string {
    $menu_a = get_menu(); // Récupère le menu pour le header

    $html = <<<HTML
    <section class="about-section">
        <h2>À propos de Javascripteurs</h2>
        <p>Ce projet est réalisé dans le cadre du Bachelor ISFCE</p>
        <p>Vous pouvez retrouver le code source sur <a href="https://github.com/shadytus/Javascripteurs" target="_blank">GitHub</a>.</p>
    </section>
    HTML;

    return join("\n", [
        html_head($menu_a),
        $html,
        html_foot(),
    ]);
}


