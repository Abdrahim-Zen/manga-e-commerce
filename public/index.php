<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/user.php';
$action = $_GET['action'] ?? 'home';
$db = new UserDB();
switch ($action) {
    case 'home':
        if (isset($_SESSION['user_id']) && $db->canUserAccess($_SESSION['user_id'], 'dashboard')) {
            header('Location: index.php?action=dashboard');
            exit();
        }
        require_once __DIR__ . '/../controllers/HomepageController.php';
        $controller = new HomepageController();
        $controller->display();
        break;

    case 'showLogin':
    case 'handleLogin':
    case 'showRegister':
    case 'handleRegister':
    case 'handleLogout':
        require_once __DIR__ . '/../controllers/LoginController.php';
        $controller = new LoginController();

        if ($action === 'showLogin') {
            if (isset($_SESSION['user_id'])) {
                header('Location: index.php?action=home');
                exit();
            }
            $controller->showLogin();
        } elseif ($action === 'handleLogin') {
            $controller->handleLogin();
        } elseif ($action === 'showRegister') {
            if (isset($_SESSION['user_id'])) {
                header('Location: index.php?action=home');
                exit();
            }
            $controller->showRegister();
        } elseif ($action === 'handleRegister') {
            $controller->handleRegister();
        } elseif ($action === 'handleLogout') {
            $controller->handleLogout();
        }
        break;

    case 'prodotto':
        if (isset($_SESSION['user_id']) && !$db->canUserAccess($_SESSION['user_id'], 'catalogo')) {
            header('Location: index.php?action=home');
            exit();
        }
        $id = $_GET['id'] ?? null;
        $category = $_GET['category'] ?? null;
        if ($id) {
            require_once __DIR__ . '/../controllers/ProdottoSingoloController.php';
            $controller = new ProdottoSingoloController();
            $controller->display($id, $category);
        }
        break;
    case 'prodotti':
        if (isset($_SESSION['user_id']) && !$db->canUserAccess($_SESSION['user_id'], 'catalogo')) {
            header('Location: index.php?action=home');
            exit();
        }
        $category = $_GET['category'] ?? null;
        $sort = $_GET['sort'] ?? null;
        if ($category) {
            require_once __DIR__ . '/../controllers/ProdottiController.php';
            $controller = new ProdottiController();

            $controller->display($category, $sort);
        }
        break;
    case 'storico':
        if (!isset($_SESSION['user_id']) || !$db->canUserAccess($_SESSION['user_id'], 'storico')) {
            header('Location: index.php?action=home&error=access_denied');
            exit();
        }
        require_once __DIR__ . '/../controllers/StoricoController.php';
        $controller = new storicoController();
        $controller->display($_SESSION['user_id']);
        break;

    case 'cart':
        if (!isset($_SESSION['user_id']) || !$db->canUserAccess($_SESSION['user_id'], 'cart')) {
            header('Location: index.php?action=home&error=access_denied');
            exit();
        }
        require_once __DIR__ . '/../controllers/CarrelloController.php';
        $cartController = new CarelloController();

        $cartAction = $_GET['cart_action'] ?? 'showCart';

        if ($cartAction === 'addToCart') {
            $cartController->addToCart();
        } elseif ($cartAction === 'ordina') {
            $cartController->ordina();
        } elseif ($cartAction === 'showCart') {
            $cartController->showCart();
        } elseif ($cartAction === 'removeFromCart') {
            $cartController->removeFromCart();
        } elseif ($cartAction === 'updateQuantity') {
            $cartController->updateQuantity();
        } else {
            $cartController->showCart();
        }
        break;
    case 'dashboard':

        if (!isset($_SESSION['user_id']) || !$db->canUserAccess($_SESSION['user_id'], 'dashboard')) {
            header('Location: index.php?action=home');
            exit();
        }
        require_once __DIR__ . '/../controllers/DashboardController.php';
        $dashboardController = new DashboardController();
        $dashboardAction = $_GET['sub_action'] ?? 'display';
        if ($dashboardAction === 'addProduct') {
            $dashboardController->addProduct();
        } elseif ($dashboardAction === 'updateQuantita') {
            $dashboardController->updateQuantita();
        } elseif ($dashboardAction === 'eliminaProdotto') {
            $dashboardController->eliminaProdotto();
        } else {
            $dashboardController->display();
        }
        break;

    default:
        require_once __DIR__ . '/../controllers/HomepageController.php';
        $controller = new HomepageController();
        $controller->display();
        break;
}
