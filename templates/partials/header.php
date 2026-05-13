<?php
require_once __DIR__ . '/../../config/user.php';
require_once __DIR__ . '/../../config/cart.php';

if (isset($_SESSION['user_id'])) {
    $auth = new UserDB();
    //$is_admin = (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin');
    $is_admin = ($auth->canUserAccess($_SESSION['user_id'], 'dashboard')) ? true : false;
    $brand_url = $is_admin ? $this->e($base_url) . '?action=dashboard' : $this->e($base_url);
} else {
    $is_admin = false;
    $brand_url = $this->e($base_url) . '?action=home';
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <?php /** @var string $base_url */
    /** @var string $site_name */ ?>
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="<?= $base_url ?>">
            <?= $site_name ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <?php if (!$is_admin): ?>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">Manga</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Figure</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Carte</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="d-flex">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if (!$is_admin): ?>
                        <button class="btn btn-outline-dark me-2" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                        </button>
                        <a class="btn btn-outline-dark" href="index.php?action=handleLogout">
                            <i class="bi-box-arrow-right me-1"></i> Logout
                        </a>
                    <?php else: ?>
                        <a class="btn btn-outline-dark" href="index.php?action=handleLogout">
                            <i class="bi-box-arrow-right me-1"></i> Logout
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <a class="btn btn-outline-dark me-2" href="index.php?action=showLogin">
                        <i class="bi-person-fill me-1"></i> Accedi
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>