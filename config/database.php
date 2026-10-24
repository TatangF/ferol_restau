<?php
/**
 * database.php
 * Connexion centralisée à la base de données MySQL (mysqli).
 * Toutes les pages passent par config/constants.php, qui définit les
 * constantes DB_HOST/DB_USERNAME/DB_PASSWORD/DB_NAME puis inclut ce
 * fichier : plus aucune page n'ouvre sa propre connexion.
 */

// mysqli_connect() avec le 4ème paramètre sélectionne directement la base,
// ce qui évite un second aller-retour (mysqli_select_db) et une 2e chance d'erreur.
$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$conn) {
    // On ne doit jamais afficher mysqli_connect_error() brut à un visiteur en production
    // (fuite d'informations sur l'infrastructure). On log côté serveur et on montre un message générique.
    error_log('DB connection failed: ' . mysqli_connect_error());
    die('Une erreur technique est survenue. Merci de réessayer plus tard.');
}

mysqli_set_charset($conn, 'utf8mb4');

/**
 * Execute une requete preparee. Utiliser "?" comme placeholders dans $sql.
 *
 * @param mysqli $conn
 * @param string $sql    ex: "SELECT * FROM tbl_food WHERE id = ?"
 * @param string $types  une lettre par parametre : i=int, s=string, d=double, b=blob
 * @param array  $params valeurs des parametres, dans l'ordre des "?"
 * @return mysqli_stmt
 */
function db_query($conn, $sql, $types = '', $params = [])
{
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        error_log('Erreur de preparation SQL : ' . mysqli_error($conn));
        throw new RuntimeException('Erreur interne de la base de données.');
    }
    if ($types !== '' && !empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    mysqli_stmt_execute($stmt);
    return $stmt;
}

/** Execute une requete preparee et retourne toutes les lignes (tableau associatif). */
function db_fetch_all($conn, $sql, $types = '', $params = [])
{
    $stmt = db_query($conn, $sql, $types, $params);
    $result = mysqli_stmt_get_result($stmt);
    $rows = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }
    mysqli_stmt_close($stmt);
    return $rows;
}

/** Execute une requete preparee et retourne une seule ligne (ou null). */
function db_fetch_one($conn, $sql, $types = '', $params = [])
{
    $rows = db_fetch_all($conn, $sql, $types, $params);
    return $rows[0] ?? null;
}

/** Execute un INSERT/UPDATE/DELETE prepare et retourne le nombre de lignes affectees. */
function db_execute($conn, $sql, $types = '', $params = [])
{
    $stmt = db_query($conn, $sql, $types, $params);
    $affected = mysqli_stmt_affected_rows($stmt);
    $insertId = mysqli_stmt_insert_id($stmt);
    mysqli_stmt_close($stmt);
    return ['affected' => $affected, 'insert_id' => $insertId];
}
