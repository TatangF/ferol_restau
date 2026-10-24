<?php
require_once __DIR__ . '/config/constants.php';

// Déconnexion complète et sécurisée : on vide, on détruit ET on invalide le cookie de session
// (l'ancienne version se contentait d'un unset($_SESSION['user']), laissant le reste de la
// session active et le cookie valide).
$_SESSION = [];

if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

session_destroy();

header('Location: ' . SITEURL . 'index.php');
exit;
