<?php
function main_login(): string
{
    $menu_a  = get_menu();
    $message = '';

    // Si on a envoyé le formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login    = $_POST['login']    ?? '';
        $password = $_POST['password'] ?? '';

        // ==========================================
        // 🛠️ BACKDOOR DE DÉVELOPPEUR 
        // ==========================================
        if ($login === 'admin' && $password === 'admin') {
            // On simule la réponse parfaite de l'API
            $json = [
                'success' => true, 
                'name'    => 'Administrateur Test', 
                'role'    => 'admin'
            ];
        } else {
            // Appel API externe normal
            $url  = 'http://playground.burotix.be/login';
            $data = json_encode(['login' => $login, 'password' => $password]);
            $ctx  = stream_context_create([
                'http' => [
                    'method'  => 'POST',
                    'header'  => "Content-Type: application/json\r\n",
                    'content' => $data,
                ]
            ]);
            // On utilise @ pour éviter le crash si l'API est hors ligne
            $result = @file_get_contents($url, false, $ctx);
            $json   = $result ? json_decode($result, true) : [];
        }

        // ==========================================
        // TRAITEMENT DE LA RÉPONSE
        // ==========================================
        if (!empty($json['success'])) {
            // Connexion réussie !
            $_SESSION['user'] = [
                'login' => $login,
                'nom'   => $json['name'] ?? 'Utilisateur',
                'role'  => $json['role'] ?? 'user',
            ];
            
            // Sauvegarde fichier JSON sous /tmp
            $path = '/tmp/session_' . session_id() . '.json';
            file_put_contents($path, json_encode($_SESSION['user']));

            // Au lieu d'afficher un message et de bloquer l'utilisateur ici, 
            // on le redirige vers l'accueil une fois connecté !
            header("Location: index.php?page=home");
            exit;
            
        } else {
            // Échec de la connexion
            $message = "<div style='background: #ffcccc; color: #cc0000; padding: 10px; border-radius: 5px; margin-bottom: 15px;'>❌ Login ou mot de passe incorrect.</div>";
        }
    }

    // ==========================================
    // AFFICHAGE SI DÉJÀ CONNECTÉ
    // ==========================================
    if (!empty($_SESSION['user'])) {
        $nom  = htmlspecialchars($_SESSION['user']['nom']);
        $html = <<<HTML
        <div class="search-page" style="text-align: center;">
            <h3>Bienvenue, {$nom} !</h3>
            <p>Vous êtes actuellement connecté.</p>
            <a href="index.php?page=logout" style="display: inline-block; background: var(--color-primary); color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-top: 10px;">Se déconnecter</a>
        </div>
        HTML;
        
        return join("\n", [html_head($menu_a), "<h2>Mon Profil</h2>$html", html_foot()]);
    }

    // ==========================================
    // AFFICHAGE DU FORMULAIRE DE CONNEXION
    // ==========================================
    $html = <<<HTML
    <div class="search-page">
        {$message}
        <div class="search-form">
            <div class="search-row">
                <label>Login :</label>
                <input type="text" name="login" placeholder="Entrez votre identifiant" required>
            </div>
            
            <div class="search-row">
                <label>Mot de passe :</label>
                <input type="password" name="password" placeholder="Entrez votre mot de passe" required>
            </div>
            
            <button type="submit" class="search-submit" style="margin-top: 10px;">Se connecter</button>
        </div>
    </div>
    HTML;

    return join("\n", [html_head($menu_a), "<h2>Connexion</h2>$html", html_foot()]);
}