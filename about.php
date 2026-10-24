<?php
require_once __DIR__ . '/config/constants.php';

$page_title = 'À propos - RESTAURANT PREMIER';
$active_page = 'about';
$page_hero_title = 'About Us';
require __DIR__ . '/includes/header.php';
?>

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
                <p class="mb-4">RESTAURANT PREMIER a ouvert ses portes en 2022 et s'est rapidement imposé comme l'une des adresses incontournables de la ville. Nous utilisons uniquement des ingrédients de qualité supérieure pour préparer les plats de nos clients : la qualité n'est jamais un compromis.</p>
                <p class="mb-4">Nous servons nos clients avec des plats de qualité premium, pour offrir une expérience gastronomique d'exception et devenir l'un des restaurants les mieux notés du pays.</p>
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
                                <h6 class="text-uppercase mb-0">Master Chefs</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-primary py-3 px-5 mt-2" href="<?php echo SITEURL; ?>menu.php">Découvrir le menu</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<?php require __DIR__ . '/includes/footer.php'; ?>
