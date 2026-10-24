<?php
require_once __DIR__ . '/config/constants.php';

$page_title = 'Créer un compte - RESTAURANT PREMIER';
$errors = [];
$old = ['name' => '', 'email' => '', 'add1' => '', 'city' => '', 'phone' => '', 'username' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_account'])) {

    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Session expirée, merci de renvoyer le formulaire.';
    } else {
        $name     = trim($_POST['name'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $add1     = trim($_POST['add1'] ?? '');
        $city     = trim($_POST['city'] ?? '');
        $phone    = trim($_POST['phone'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = (string) ($_POST['password'] ?? '');

        $old = compact('name', 'email', 'add1', 'city', 'phone', 'username');

        // --- Validation côté serveur (indispensable : la validation HTML5 seule peut être contournée) ---
        if ($name === '' || $email === '' || $add1 === '' || $city === '' || $phone === '' || $username === '' || $password === '') {
            $errors[] = 'Merci de remplir tous les champs.';
        }
        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Adresse email invalide.';
        }
        if ($phone !== '' && !preg_match('/^\+?[0-9 ]{6,20}$/', $phone)) {
            $errors[] = 'Numéro de téléphone invalide.';
        }
        if (strlen($password) < 8) {
            $errors[] = 'Le mot de passe doit contenir au moins 8 caractères.';
        }
        if (strlen($username) < 3) {
            $errors[] = "L'identifiant doit contenir au moins 3 caractères.";
        }

        if (empty($errors)) {
            $existing = db_fetch_one(
                $conn,
                'SELECT id FROM tbl_users WHERE username = ? LIMIT 1',
                's',
                [$username]
            );

            if ($existing) {
                $errors[] = 'Ce nom d\'utilisateur existe déjà. Merci d\'en choisir un autre.';
            } else {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                db_execute(
                    $conn,
                    'INSERT INTO tbl_users (name, email, add1, city, phone, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)',
                    'sssssss',
                    [$name, $email, $add1, $city, $phone, $username, $passwordHash]
                );

                set_flash('success', 'Compte créé avec succès. Vous pouvez vous connecter.');
                header('Location: ' . SITEURL . 'login.php');
                exit;
            }
        }
    }
}

$active_page = null;
$page_hero_title = null;
require __DIR__ . '/includes/header.php';
?>

<div class="container py-5" style="max-width: 560px;">
    <h2 class="text-center mb-4">Créer un compte</h2>

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
            <input type="text" class="form-control" id="name" name="name" placeholder="Nom" required value="<?php echo e($old['name']); ?>">
            <label for="name">Nom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required value="<?php echo e($old['email']); ?>">
            <label for="email">Email</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="add1" name="add1" placeholder="Adresse" required value="<?php echo e($old['add1']); ?>">
            <label for="add1">Adresse</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="city" name="city" placeholder="Ville" required value="<?php echo e($old['city']); ?>">
            <label for="city">Ville</label>
        </div>
        <div class="form-floating mb-3">
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Téléphone" required value="<?php echo e($old['phone']); ?>">
            <label for="phone">Téléphone</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Identifiant" required value="<?php echo e($old['username']); ?>">
            <label for="username">Identifiant</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" minlength="8" required>
            <label for="password">Mot de passe (8 caractères minimum)</label>
        </div>
        <button type="submit" name="create_account" value="create_account" class="btn btn-primary w-100 py-2">Créer mon compte</button>
        <p class="text-center mt-3">
            Déjà inscrit ? <a href="<?php echo SITEURL; ?>login.php">Se connecter</a>
        </p>
    </form>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
