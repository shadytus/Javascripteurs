<?php
function main_login(): string
{
    $menu_a  = get_menu();
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login    = $_POST['login']    ?? '';
        $password = $_POST['password'] ?? '';

        // Appel API externe
        $url  = 'http://playground.burotix.be/login';
        $data = json_encode(['login' => $login, 'password' => $password]);
        $ctx  = stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/json\r\n",
                'content' => $data,
            ]
        ]);
        $result = @file_get_contents($url, false, $ctx);
        $json   = json_decode($result, true);

        if (!empty($json['success'])) {
            $_SESSION['user'] = [
                'login' => $login,
                'nom'   => $json['name'],
                'role'  => $json['role'],
            ];
            // ✅ Sauvegarde fichier JSON sous /tmp
            $path = '/tmp/session_' . session_id() . '.json';
            file_put_contents($path, json_encode($_SESSION['user']));

            $message = "<p class='success'>✅ Bonjour {$json['name']} !</p>";
        } else {
            $message = "<p class='error'>❌ Login ou mot de passe incorrect.</p>";
        }
    }

    // Si déjà connecté
    if (!empty($_SESSION['user'])) {
        $nom  = $_SESSION['user']['nom'];
        $html = "<p>Connecté en tant que <strong>$nom</strong></p>
                 <a href='index.php?page=logout'>Se déconnecter</a>";
        return join("\n", [html_head($menu_a), "<h2>Connexion</h2>$html", html_foot()]);
    }

    $html = $message . <<<HTML
    <form method="POST" action="index.php?page=login">
        <label>Login :
            <input type="text" name="login" required>
        </label><br><br>
        <label>Mot de passe :
            <input type="password" name="password" required>
        </label><br><br>
        <button type="submit">Se connecter</button>
    </form>
    HTML;

    return join("\n", [html_head($menu_a), "<h2>Connexion</h2>$html", html_foot()]);
}

function main_logout(): string
{
    // Supprime le fichier JSON
    $path = '/tmp/session_' . session_id() . '.json';
    if (file_exists($path)) unlink($path);

    unset($_SESSION['user']);
    header('Location: index.php?page=home');
    exit;
}
