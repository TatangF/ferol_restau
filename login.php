<?php
require_once __DIR__ . '/config/constants.php';

$page_title = 'Connexion - RESTAURANT PREMIER';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Session expirée, merci de renvoyer le formulaire.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = (string) ($_POST['password'] ?? '');

        if ($username === '' || $password === '') {
            $errors[] = 'Merci de renseigner votre identifiant et votre mot de passe.';
        } else {
            // Requête préparée : plus aucune concaténation de valeurs utilisateur dans le SQL.
            $user = db_fetch_one(
                $conn,
                'SELECT id, username, password FROM tbl_users WHERE username = ? LIMIT 1',
                's',
                [$username]
            );

            $loginOk = false;

            if ($user) {
                // password_hash()/password_verify() est le standard actuel.
                // Les comptes créés avant cette mise à jour ont un mot de passe hashé en MD5 :
                // on les authentifie une dernière fois via MD5 puis on migre silencieusement
                // le mot de passe vers password_hash(), sans jamais forcer l'utilisateur à le changer.
                if (password_verify($password, $user['password'])) {
                    $loginOk = true;
                } elseif (strlen($user['password']) === 32 && hash_equals($user['password'], md5($password))) {
                    $loginOk = true;
                    $newHash = password_hash($password, PASSWORD_DEFAULT);
                    db_execute($conn, 'UPDATE tbl_users SET password = ? WHERE id = ?', 'si', [$newHash, $user['id']]);
                }
            }

            if ($loginOk) {
                session_regenerate_id(true); // empêche la fixation de session après connexion
                $_SESSION['user'] = $user['username'];
                $_SESSION['user_id'] = $user['id'];
                set_flash('success', 'Connexion réussie. Bienvenue ' . $user['username'] . ' !');
                header('Location: ' . SITEURL . 'index.php');
                exit;
            }

            $errors[] = 'Identifiant ou mot de passe incorrect.';
        }
    }
}

$active_page = 'login';
$page_hero_title = null;
require __DIR__ . '/includes/header.php';
?>

<div class="container py-5" style="max-width: 480px;">
    <h2 class="text-center mb-4">Connexion</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <div><?php echo e($error); ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST" novalidate>
        <?php csrf_field(); ?>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Identifiant" required
                   value="<?php echo isset($_POST['username']) ? e($_POST['username']) : ''; ?>">
            <label for="username">Identifiant</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
            <label for="password">Mot de passe</label>
        </div>
        <button type="submit" name="submit" value="login" class="btn btn-primary w-100 py-2">Se connecter</button>
        <p class="text-center mt-3">
            Pas encore de compte ? <a href="<?php echo SITEURL; ?>register.php">Créer un compte</a>
        </p>
    </form>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
