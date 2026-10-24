<?php
// Attend $page_title (onglet navigateur) et éventuellement $page_hero_title (bandeau de titre)
$page_title = $page_title ?? 'RESTAURANT PREMIER';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title><?php echo e($page_title); ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="RESTAURANT PREMIER - Restaurant de cuisine camerounaise à Yaoundé">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo SITEURL; ?>img/logo_ntx.png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo SITEURL; ?>lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo SITEURL; ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo SITEURL; ?>lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo SITEURL; ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo SITEURL; ?>css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <?php require __DIR__ . '/navbar.php'; ?>

            <?php if (!empty($page_hero_title)): ?>
            <div class="container-xxl py-5 bg-dark hero-header mb-1">
                <div class="container text-center my-3 pt-1 pb-1">
                    <h1 class="display-3 text-white mb-3 animated slideInDown"><?php echo e($page_hero_title); ?></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="<?php echo SITEURL; ?>index.php">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page"><?php echo e($page_hero_title); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <!-- Navbar & Hero End -->

        <?php render_flash(); ?>
