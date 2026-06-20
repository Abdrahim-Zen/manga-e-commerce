<?php
require_once __DIR__ . '/../../config/user.php';
require_once __DIR__ . '/../../config/cart.php';
/** @var array  $user */
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

<style>
    .site-header {
        background: var(--dark);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: none;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .site-header::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 1px;
        background-color: #000000;
        backdrop-filter: none;
    }

    .navbar-brand-logo {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.9rem;
        letter-spacing: 0.05em;
        color: var(--text) !important;
        text-decoration: none;
        line-height: 1;
    }

    .navbar-brand-logo span {
        color: #43766C;
    }

    .nav-link-item {
        font-size: 0.72rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--text) !important;
        padding: 0.5rem 0.85rem !important;
        transition: color 0.2s;
        text-decoration: none;
        cursor: pointer;
    }

    .nav-link-item:hover,
    .nav-link-item:focus {
        color: var(--text-hover2) !important;
    }

    .btn-header-cta {
        background: #A27B5C;
        color: #fff !important;
        border: none;
        border-radius: 4px;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        padding: 0.45rem 1.1rem;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s;
        display: inline-block;
    }

    .btn-header-cta:hover {
        background: var(--accent);
        transform: translateY(-1px);
        color: #fff !important;
    }

    .navbar-toggler {
        border: 1px solid rgba(255, 255, 255, 0.14) !important;
        border-radius: 4px;
        padding: 0.3rem 0.5rem;
        background: transparent !important;
        box-shadow: none !important;
    }

    /* Dropdown */
    .header-dropdown {
        background: var(--dark) !important;
        border-radius: 6px !important;
        padding: 0.4rem 0 !important;
        min-width: 170px;

    }

    .header-dropdown .dropdown-item {
        font-size: 0.82rem;
        color: var(--text) !important;
        padding: 0.55rem 1rem;
        transition: color 0.2s, background 0.2s;
    }

    .header-dropdown .dropdown-item:hover {
        background: rgba(255, 255, 255, 0.05);
        color: #ededed;
    }

    .header-dropdown .dropdown-item.danger {
        color: #ef4444;

    }


    .header-dropdown hr {
        border-color: rgba(255, 255, 255, 0.07);
        margin: 0.3rem 0;
    }

    .header-dropdown-icon {
        color: #43766C;
        margin-right: 0.5rem;
    }

    /* Cart badge */
    .cart-count-badge {
        position: absolute;
        top: -7px;
        right: -8px;
        background: var(--accent);
        color: #fff;
        font-size: 0.6rem;
        font-weight: 700;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }
</style>

<header class="site-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg py-3">

            <!-- Brand -->
            <a class="navbar-brand-logo" href="<?= $brand_url ?>">
                MANGA<span>XENO</span>
            </a>

            <!-- Mobile toggle -->
            <button class="navbar-toggler ms-auto" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMain"
                aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-4" style="color:#ededed;"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">

                <!-- Left links -->
                <ul class="navbar-nav me-auto align-items-lg-center ms-3 gap-1">

                    <?php if (!$is_admin): ?>


                        <li class="nav-item dropdown">
                            <a class="nav-link-item dropdown-toggle" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categorie
                            </a>
                            <ul class="dropdown-menu header-dropdown">
                                <li>
                                    <a class="dropdown-item" href="index.php?category=manga&action=prodotti">
                                        <i class="bi bi-book header-dropdown-icon"></i>Manga
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?category=carta&action=prodotti">
                                        <i class="bi bi-card-text header-dropdown-icon"></i>Card Game
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?category=figure&action=prodotti">
                                        <i class="bi bi-person-badge header-dropdown-icon"></i>Figure
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>

                <!-- Right side -->
                <div class="d-flex align-items-center gap-3">

                    <!-- Cart icon (solo utenti non-admin) -->


                    <!-- Admin dropdown -->
                    <?php if ($is_admin): ?>
                        <div class="nav-item dropdown">
                            <a class="nav-link-item dropdown-toggle" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-shield-check me-1" style="color:var(--accent);"></i>

                                <?= $this->e($user['name']) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end header-dropdown">
                                <li>
                                    <a class="dropdown-item danger" href="index.php?action=handleLogout">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- User dropdown -->
                    <?php elseif (isset($user) && !$is_admin): ?>
                        <a href="index.php?action=cart&cart_action=showCart"
                            class="position-relative"
                            style="color:#aaa; font-size:1.1rem; text-decoration:none; transition:color 0.2s;"
                            title="Carrello">
                            <i class="bi bi-bag"></i>
                            <?php
                            $cartCount = 0;
                            if (isset($_SESSION['user_id'])) {
                                $db = new CartDB();
                                $cartCount = $db->getCartCount($_SESSION['user_id']);
                            }
                            if ($cartCount > 0): ?>
                                <span class="cart-count-badge"><?= $cartCount ?></span>
                            <?php endif; ?>
                        </a>
                        <div class="nav-item dropdown">
                            <a class="nav-link-item dropdown-toggle" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i>
                                <?= $this->e($user['name']) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end header-dropdown">
                                <li>
                                    <a class="dropdown-item" href="index.php?action=cart&cart_action=showCart">
                                        <i class="bi bi-bag header-dropdown-icon"></i>Carrello
                                    </a>
                                </li>
                                <li>
                                    <hr>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?action=storico">
                                        <i class="bi bi-bag header-dropdown-icon"></i>Storico Ordini
                                    </a>
                                </li>

                                <li>
                                    <hr>
                                </li>
                                <li>
                                    <a class="dropdown-item danger" href="index.php?action=handleLogout">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Guest -->
                    <?php else: ?>
                        <a href="index.php?action=showLogin" class="nav-link-item">Accedi</a>
                        <a href="index.php?action=showRegister" class="btn-header-cta">Registrati</a>
                    <?php endif; ?>

                </div>
            </div>
        </nav>
    </div>
</header>