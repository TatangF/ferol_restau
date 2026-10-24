<?php
/**
 * functions.php
 * Fonctions utilitaires partagées par toutes les pages.
 */

/**
 * Échappe une chaîne pour un affichage HTML sûr (protection XSS).
 * À utiliser systématiquement autour de toute donnée venant de la BDD
 * ou de l'utilisateur avant de l'afficher dans une page.
 */
function e($string)
{
    return htmlspecialchars((string) ($string ?? ''), ENT_QUOTES, 'UTF-8');
}

/**
 * Génère (ou réutilise) un jeton CSRF stocké en session.
 */
function generate_csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Vérifie un jeton CSRF soumis par un formulaire.
 */
function verify_csrf_token($token)
{
    return isset($_SESSION['csrf_token']) && is_string($token) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Affiche un champ input hidden contenant le jeton CSRF courant.
 * Utilisation : <?php csrf_field(); ?> dans chaque <form method="POST">.
 */
function csrf_field()
{
    echo '<input type="hidden" name="csrf_token" value="' . e(generate_csrf_token()) . '">';
}

function is_logged_in()
{
    return isset($_SESSION['user']);
}

/**
 * Redirige vers login.php si l'utilisateur n'est pas connecté.
 * À appeler en haut de toute page nécessitant une authentification.
 */
function require_login()
{
    if (!is_logged_in()) {
        header('Location: ' . SITEURL . 'login.php');
        exit;
    }
}

/**
 * Stocke un message flash (succès/erreur) affiché une seule fois après redirection.
 */
function set_flash($type, $message)
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

/**
 * Récupère puis efface le message flash courant, s'il existe.
 */
function get_flash()
{
    if (empty($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

/**
 * Affiche le message flash sous forme d'alerte Bootstrap, s'il y en a un.
 */
function render_flash()
{
    $flash = get_flash();
    if (!$flash) {
        return;
    }
    $alertClass = $flash['type'] === 'success' ? 'alert-success' : 'alert-danger';
    echo '<div class="container mt-4"><div class="alert ' . $alertClass . ' alert-dismissible fade show" role="alert">'
        . e($flash['message'])
        . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
        . '</div></div>';
}
