<?php

function main_auth_fetch(): string
{
    header('Content-Type: application/json');
    $action = $_GET['action'] ?? '';

    if ($action === 'logout') {
        unset($_SESSION['user']);
        return json_encode(['success' => true, 'message' => 'Déconnecté']);
    }

    if ($action === 'check') {
        if (isset($_SESSION['user'])) {
            return json_encode([
                'success' => true, 
                'user_name' => $_SESSION['user']['nom']
            ]);
        } else {
            return json_encode(['success' => false]);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        $login = $input['login'] ?? '';
        $password = $input['password'] ?? '';

        $url = 'http://playground.burotix.be/login';
        $ctx = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n",
                'content' => json_encode(['login' => $login, 'password' => $password]),
            ]
        ]);
        $result = @file_get_contents($url, false, $ctx);
        $json = $result ? json_decode($result, true) : [];

        if (!empty($json['success'])) {
            $_SESSION['user'] = [
                'login' => $login,
                'nom'   => $json['name'] ?? 'Utilisateur',
                'role'  => $json['role'] ?? 'user',
            ];
            
            return json_encode([
                'success' => true, 
                'user_name' => $_SESSION['user']['nom'],
                'role' => $_SESSION['user']['role']
            ]);
        } else {
            return json_encode(['success' => false, 'message' => 'inconnu']);
        }
    }
    return json_encode(['success' => false]);
}