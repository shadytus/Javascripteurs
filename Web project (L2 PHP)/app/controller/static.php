<?php
function main_static(): string
{
    $menu_a   = get_menu();
    $content  = get_static_content('apropos');

    $html = <<<HTML
    <section class="apropos">
        <h2>{$content['titre']}</h2>
        <p>{$content['description']}</p>

        <h3>✅ Fonctionnalités implantées</h3>
        <ul>
    HTML;

    foreach ($content['fonctionnalites']['implantees'] as $f) {
        $html .= "<li>{$f}</li>";
    }

    $html .= <<<HTML
        </ul>
        <h3>🔜 En cours</h3>
        <ul>
    HTML;

    foreach ($content['fonctionnalites']['en_cours'] as $f) {
        $html .= "<li>{$f}</li>";
    }

    $html .= <<<HTML
        </ul>
        <h3>🔑 Logins de test</h3>
        <table border="1">
            <tr><th>Login</th><th>Mot de passe</th><th>Rôle</th></tr>
    HTML;

    foreach ($content['logins'] as $login) {
        $html .= "<tr>
            <td>{$login['login']}</td>
            <td>{$login['password']}</td>
            <td>{$login['role']}</td>
        </tr>";
    }

    $html .= "</table></section>";

    return join("\n", [
        html_head($menu_a),
        $html,
        html_foot(),
    ]);
}
