<?php
session_start();
require '../vendor/autoload.php';

$action = $_GET['action'] ?? 'home';


switch ($action) {
    case 'home':
        require '../controllers/HomepageController.php';
        $controller = new HomepageController();
        $controller->display();
        break;
    case 'prodotto':
        $id = $_GET['id'] ?? null;
        $category = $_GET['category'] ?? null;
        require '../controllers/ProdottoSingoloController.php';
        $controller = new ProdottoSingoloController();
        $controller->display($id, $category);
        break;
    case 'showLogin':
        require '../controllers/LoginController.php';
        $controller = new LoginController();
        $controller->showLogin();
        break;
    case 'handleLogin':
        require '../controllers/LoginController.php';
        $controller = new LoginController();
        $controller->handleLogin();
        break;
    case 'handleLogout':
        require '../controllers/LoginController.php';
        $controller = new LoginController();
        $controller->handleLogout();
        break;
    case 'productsbyCategory':
        require '../controllers/prodottiByCategoryController.php';
        require '../config/user.php';
        $db = new UserDB();
        $category = $_GET['category'];
        $controller = new ProdottiByCategoryController();
        $controller->display($category);
        break;
    case 'dashboard':
        require '../config/user.php';
        $db = new UserDB();

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
    case 'cart':
        require '../config/user.php';
        $db = new UserDB();
        if (!isset($_SESSION['user_id']) && !$db->canUserAccess($_SESSION['user_id'], 'cart')) {
            header('Location: index.php?action=home');
            exit();
        }
        require_once __DIR__ . '/../controllers/carrelloController.php';
        $controller = new CarelloController();
        $cartAction = $_GET['cart_action'];
        if ($cartAction === 'addToCart') {
            $controller->addToCart();
        } elseif ($cartAction === 'showCart') {
            $controller->showCart();
        } elseif ($cartAction === 'removeFromCart') {
            $controller->removeFromCart();
        } elseif ($cartAction === 'updateQuantity') {
            $controller->updateQuantity();
        }
        break;
    default:
        require '../controllers/HomepageController.php';
        $controller = new HomepageController();
        $controller->display();
        break;
}





?>