<?php
// Attend une variable $active_page définie par la page appelante ('home', 'about', 'categories', 'menu', 'contact')
$active_page = $active_page ?? '';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
    <a href="<?php echo SITEURL; ?>index.php" class="navbar-brand p-0">
        <img src="<?php echo SITEURL; ?>img/logo_ntx.png" alt="Restaurant Premier">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0 pe-4">
            <a href="<?php echo SITEURL; ?>index.php" class="nav-item nav-link <?php echo $active_page === 'home' ? 'active' : ''; ?>">Home</a>
            <a href="<?php echo SITEURL; ?>about.php" class="nav-item nav-link <?php echo $active_page === 'about' ? 'active' : ''; ?>">About</a>
            <a href="<?php echo SITEURL; ?>categories.php" class="nav-item nav-link <?php echo $active_page === 'categories' ? 'active' : ''; ?>">Categories</a>
            <a href="<?php echo SITEURL; ?>menu.php" class="nav-item nav-link <?php echo $active_page === 'menu' ? 'active' : ''; ?>">Menu</a>
            <a href="<?php echo SITEURL; ?>contact.php" class="nav-item nav-link <?php echo $active_page === 'contact' ? 'active' : ''; ?>">Contact</a>

            <?php if (is_logged_in()): ?>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?php echo e($_SESSION['user']); ?></a>
                    <div class="dropdown-menu m-0">
                        <a href="<?php echo SITEURL; ?>logout.php" class="dropdown-item">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="<?php echo SITEURL; ?>login.php" class="nav-item nav-link <?php echo $active_page === 'login' ? 'active' : ''; ?>">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
