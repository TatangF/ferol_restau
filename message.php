<?php
require_once __DIR__ . '/config/constants.php';
date_default_timezone_set('Africa/Douala'); // "Africa/Cameroun" n'est pas un fuseau IANA valide et déclenchait un warning PHP

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_message'])) {

    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash('error', 'Session expirée, merci de renvoyer votre message.');
        header('Location: ' . SITEURL . 'contact.php');
        exit;
    }

    $name    = trim($_POST['name'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $errors = [];
    if ($name === '' || $phone === '' || $subject === '' || $message === '') {
        $errors[] = 'Merci de remplir tous les champs.';
    }
    if ($phone !== '' && !preg_match('/^\+?[0-9 ]{6,20}$/', $phone)) {
        $errors[] = 'Numéro de téléphone invalide.';
    }

    if (!empty($errors)) {
        set_flash('error', implode(' ', $errors));
        header('Location: ' . SITEURL . 'contact.php');
        exit;
    }

    $messageStatus = 'unread';
    $date = date('Y-m-d H:i:s');

    // Requête préparée : corrige l'injection SQL de la version précédente,
    // qui concaténait directement $_POST['name'], $_POST['subject'], etc. dans le SQL.
    db_execute(
        $conn,
        'INSERT INTO message (name, phone, subject, message, message_status, date) VALUES (?, ?, ?, ?, ?, ?)',
        'ssssss',
        [$name, $phone, $subject, $message, $messageStatus, $date]
    );

    set_flash('success', 'Votre message a bien été envoyé. Nous vous répondrons rapidement.');
    header('Location: ' . SITEURL . 'contact.php');
    exit;
}

// Accès direct à message.php sans POST : on renvoie simplement vers le formulaire.
header('Location: ' . SITEURL . 'contact.php');
exit;
