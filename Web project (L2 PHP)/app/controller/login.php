<?php
function main_login(): string
{
    $menu_a  = get_menu();
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login    = $_POST['login']    ?? '';
        $password = $_POST['password'] ?? '';

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
        $json   = $result ? json_decode($result, true) : [];

        if (!empty($json['success'])) {
            $_SESSION['user'] = [
                'login' => $login,
                'nom'   => $json['name'] ?? 'Utilisateur',
                'role'  => $json['role'] ?? 'user',
            ];
            
            header("Location: index.php?page=home");
            exit;
        } else {
            $message = "❌ Login ou mot de passe incorrect.";
        }
    }

    $user = $_SESSION['user'] ?? null;
    $banner = get_banner_html();
    
    if ($user) {
        $content = html_login_profile($user);
    } else {
        $content = html_login_form($message);
    }

    return html_head($menu_a, $user, 'login') . $content . html_foot($banner);
}