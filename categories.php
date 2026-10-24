<?php
require_once __DIR__ . '/config/constants.php';

$page_title = 'Catégories - RESTAURANT PREMIER';
$active_page = 'categories';
$page_hero_title = 'Categories';

// Requête préparée (aucune valeur utilisateur ici, mais on garde le même helper partout
// pour la cohérence et pour éviter toute régression future si un filtre est ajouté).
$categories = db_fetch_all($conn, "SELECT id, title, image_name FROM tbl_category WHERE active = 'Yes' ORDER BY title ASC");

require __DIR__ . '/includes/header.php';
?>

<!-- Categories Start -->
<div class="container py-5">
    <div class="row g-4">
        <?php if (empty($categories)): ?>
            <p class="text-center">Aucune catégorie disponible pour le moment.</p>
        <?php else: ?>
            <?php foreach ($categories as $cat): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card h-100">
                        <img src="<?php echo SITEURL . 'images/category/' . e($cat['image_name']); ?>" class="card-img-top" alt="<?php echo e($cat['title']); ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo e($cat['title']); ?></h5>
                            <a href="<?php echo SITEURL; ?>menu.php?category_id=<?php echo (int) $cat['id']; ?>">
                                <button class="btn btn-primary btn-sm">Explore Category</button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<!-- Categories End -->

<?php require __DIR__ . '/includes/footer.php'; ?>
