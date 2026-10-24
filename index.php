<?php
require_once __DIR__ . '/config/constants.php';

$page_title = 'RESTAURANT PREMIER';
$active_page = 'home';
$page_hero_title = null; // la home a son propre grand hero ci-dessous, pas le bandeau standard

// Requête préparée même sans entrée utilisateur : cohérence avec le reste du projet.
$featuredFoods = db_fetch_all($conn, "SELECT id, title, price, image_name FROM tbl_food WHERE featured = 'Yes' AND active = 'Yes'");

require __DIR__ . '/includes/header.php';
?>

<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container my-5 py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-3 text-white animated slideInLeft">Enjoy Our<br>RESTAURANT PREMIER</h1>
                <p class="text-white animated slideInLeft mb-4 pb-2">Cuisine camerounaise authentique, préparée avec des ingrédients de qualité.</p>
                <a href="<?php echo SITEURL; ?>categories.php" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Explore Categories</a>
            </div>
            <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                <img class="img-fluid" src="<?php echo SITEURL; ?>img/hero.png" alt="RESTAURANT PREMIER">
            </div>
        </div>
    </div>
</div>

<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-user-tie text-primary mb-4"></i>
                        <h5>Master Chefs</h5>
                        <p>Our Restaurant employs top quality chefs with experience in high class work environments.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-utensils text-primary mb-4"></i>
                        <h5>Quality Food</h5>
                        <p>Foods made with perfection. We believe in supreme quality in our foods.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-cart-plus text-primary mb-4"></i>
                        <h5>Online Order</h5>
                        <p>Easy online and in restaurant ordering system. Contactless delivery guaranteed.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-headset text-primary mb-4"></i>
                        <h5>Contactless Service</h5>
                        <p>Robo Cafe promises customers a contactless food service during this pandemic.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->

<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s" src="<?php echo SITEURL; ?>img/about-1.jpg" alt="Restaurant Premier">
                    </div>
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s" src="<?php echo SITEURL; ?>img/about-2.jpg" style="margin-top: 25%;" alt="Restaurant Premier">
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s" src="<?php echo SITEURL; ?>img/about-3.jpg" alt="Restaurant Premier">
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s" src="<?php echo SITEURL; ?>img/about-4.jpg" alt="Restaurant Premier">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h5 class="section-title ff-secondary text-start text-primary fw-normal">About Us</h5>
                <h1 class="mb-4">Welcome to <i class="fa fa-utensils text-primary me-2"></i>RESTAURANT PREMIER</h1>
                <p class="mb-4">RESTAURANT PREMIER a ouvert ses portes en 2022 et s'est rapidement imposé comme l'une des adresses incontournables de la ville, avec des plats préparés à partir d'ingrédients de qualité supérieure.</p>
                <p class="mb-4">Nous servons nos clients avec des plats de qualité premium, pour offrir une expérience gastronomique d'exception.</p>
                <div class="row g-4 mb-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                            <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">5</h1>
                            <div class="ps-4">
                                <p class="mb-0">Years of</p>
                                <h6 class="text-uppercase mb-0">Experience</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                            <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">10</h1>
                            <div class="ps-4">
                                <p class="mb-0">Popular</p>
                                <h6 class="text-uppercase mb-0">Chefs</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-primary py-3 px-5 mt-2" href="<?php echo SITEURL; ?>about.php">Read More</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Featured Product Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Featured Items</h5>
            <h1 class="mb-5">Our Popular Dishes</h1>
            <div class="row g-4">
                <?php if (empty($featuredFoods)): ?>
                    <p class="text-center">Aucun plat vedette pour le moment.</p>
                <?php else: ?>
                    <?php foreach ($featuredFoods as $food): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card h-100">
                                <img src="<?php echo SITEURL . 'images/food/' . e($food['image_name']); ?>" class="card-img-top" alt="<?php echo e($food['title']); ?>">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo e($food['title']); ?></h5>
                                    <p class="card-text"><?php echo e($food['price']); ?></p>
                                    <!-- Voir menu.php : le panier est désactivé tant que manage-cart.php n'est pas fourni. -->
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
    </div>
</div>
<!-- Featured Product End -->

<?php require __DIR__ . '/includes/footer.php'; ?>
