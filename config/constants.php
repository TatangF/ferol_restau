<?php

/**
 * constants.php
 * Point d'entree unique de configuration, inclus par toutes les pages.
 *
 * Corrections apportees :
 * - SITEURL etait code en dur sur une IP LAN (192.168.0.200) : le site plantait
 *   des qu'on y accedait via localhost ou un autre poste. Il est desormais
 *   calcule automatiquement a partir de la requete courante.
 * - La session est demarree avec des options de securite (cookie HttpOnly,
 *   SameSite) AVANT tout output, ce qui evite aussi le warning
 *   "headers already sent" que ob_start() masquait auparavant.
 * - La connexion MySQL et les fonctions utilitaires sont deplacees dans des
 *   fichiers dedies (config/database.php, includes/functions.php) pour
 *   respecter la separation des responsabilites.
 */

// --- SITEURL : calcule dynamiquement, fonctionne sur n'importe quelle machine XAMPP ---
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
// Racine du site = dossier contenant ce fichier config/, remonte d'un niveau
$scriptDir = str_replace('\\', '/', dirname(dirname($_SERVER['SCRIPT_NAME'] ?? '/ferol_restau/index.php')));
$basePath  = rtrim($scriptDir, '/') . '/';
define('SITEURL', $protocol . $host . $basePath);

// --- Base de donnees ---
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');

// --- Session securisee (a definir AVANT session_start()) ---
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'httponly' => true,     // le cookie de session n'est pas accessible en JavaScript (anti-XSS)
        'samesite' => 'Lax',    // limite les envois du cookie depuis un site tiers (anti-CSRF partiel)
    ]);
    session_start();
}

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../includes/functions.php';

