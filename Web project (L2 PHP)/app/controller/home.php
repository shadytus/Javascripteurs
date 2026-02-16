<?php
function main_home(): string
{
    // model
    $menu_a = get_menu();

    // view
    return join("\n", [
        html_head($menu_a),
        "<h2>Bienvenue sur le site de presse</h2>",
        "<p>Chargement des articles...</p>",
        html_foot(),
    ]);
}
```
