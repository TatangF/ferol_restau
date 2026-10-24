<?php
require_once __DIR__ . '/config/constants.php';

$page_title = 'Menu - RESTAURANT PREMIER';
$active_page = 'menu';
$page_hero_title = 'Menu';

// --- Nouveau : recherche par nom de plat + filtre par catégorie (fonctionnalité F du cahier des charges) ---
$search = trim($_GET['q'] ?? '');
$categoryId = isset($_GET['category_id']) ? (int) $_GET['category_id'] : 0;

$sql = "SELECT id, title, price, image_name FROM tbl_food WHERE active = 'Yes'";
$types = '';
$params = [];

if ($search !== '') {
    $sql .= ' AND title LIKE ?';
    $types .= 's';
    $params[] = '%' . $search . '%';
}
if ($categoryId > 0) {
    $sql .= ' AND category_id = ?';
    $types .= 'i';
    $params[] = $categoryId;
}
$sql .= ' ORDER BY title ASC';

$foods = db_fetch_all($conn, $sql, $types, $params);
$categories = db_fetch_all($conn, "SELECT id, title FROM tbl_category WHERE active = 'Yes' ORDER BY title ASC");

require __DIR__ . '/includes/header.php';
?>

<!-- Menu Start -->
<div class="container py-5">

    <!-- Barre de recherche et filtre par catégorie -->
    <form action="" method="GET" class="row g-2 mb-4">
        <div class="col-md-6">
            <input type="text" name="q" class="form-control" placeholder="Rechercher un plat..." value="<?php echo e($search); ?>">
        </div>
        <div class="col-md-4">
            <select name="category_id" class="form-select">
                <option value="0">Toutes les catégories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo (int) $cat['id']; ?>" <?php echo $categoryId === (int) $cat['id'] ? 'selected' : ''; ?>>
                        <?php echo e($cat['title']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filtrer</button>
        </div>
    </form>

    <div class="row g-4">
        <?php if (empty($foods)): ?>
            <p class="text-center">Aucun plat ne correspond à votre recherche.</p>
        <?php else: ?>
            <?php foreach ($foods as $food): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card h-100">
                        <img src="<?php echo SITEURL . 'images/food/' . e($food['image_name']); ?>" class="card-img-top" alt="<?php echo e($food['title']); ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo e($food['title']); ?></h5>
                            <p class="card-text"><?php echo e($food['price']); ?></p>
                            <!--
                                Le panier ("Add To Cart" -> manage-cart.php) référencé dans l'ancienne
                                version n'a pas de fichier manage-cart.php dans le projet fourni.
                                Le bouton est donc désactivé plutôt que de pointer vers une page 404.
                                Fournir manage-cart.php (ou le module panier) pour le réactiver.
                            -->
                            <button type="button" class="btn btn-outline-secondary btn-sm" disabled title="Bientôt disponible">
                                Add To Cart
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<!-- Menu Ends -->

<?php require __DIR__ . '/includes/footer.php'; ?>
