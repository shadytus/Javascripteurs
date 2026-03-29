<?php
header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

// --- LOGIQUE DE DÉCONNEXION ---
if ($action === 'logout') {
    $path = '/tmp/session_' . session_id() . '.json';
    if (file_exists($path)) unlink($path);
    
    unset($_SESSION['user']);
    echo json_encode(['success' => true, 'message' => 'Déconnecté']);
    exit;
}

// --- LOGIQUE DE CONNEXION ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données Fetch (JSON ou FormData)
    $input = json_decode(file_get_contents('php://input'), true);
    $login = $input['login'] ?? '';
    $password = $input['password'] ?? '';

    // Backdoor ou Appel API Burotix
    if ($login === 'admin' && $password === 'admin') {
        $json = ['success' => true, 'name' => 'Administrateur Test', 'role' => 'admin'];
    } else {
        $url = 'http://playground.burotix.be/login';
        // Appel API externe via POST [cite: 175, 176]
        $ctx = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n",
                'content' => json_encode(['login' => $login, 'password' => $password]),
            ]
        ]);
        $result = @file_get_contents($url, false, $ctx);
        $json = $result ? json_decode($result, true) : [];
    }

    if (!empty($json['success'])) {
        $_SESSION['user'] = [
            'login' => $login,
            'nom'   => $json['name'] ?? 'Utilisateur',
            'role'  => $json['role'] ?? 'user',
        ];
        
        // Sauvegarde temporaire demandée dans ton projet 2
        file_put_contents('/tmp/session_' . session_id() . '.json', json_encode($_SESSION['user']));

        echo json_encode([
            'success' => true, 
            'user_name' => $_SESSION['user']['nom'],
            'role' => $_SESSION['user']['role']
        ]);
    } else {
        // En cas d'échec, on renvoie l'expression "inconnu" 
        echo json_encode(['success' => false, 'message' => 'inconnu']);
    }
    exit;
}