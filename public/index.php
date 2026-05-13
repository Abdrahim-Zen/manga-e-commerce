<?php
session_start();
require '../vendor/autoload.php';
require '../config/user.php';

$action = $_GET['action'] ?? 'home';
$db = new UserDB();
switch ($action) {
    case 'home':
        if (isset($_SESSION['user_id']) && $db->canUserAccess($_SESSION['user_id'], 'dashboard')) {
            header('Location: index.php?action=dashboard');
            exit();
        }
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
    case 'handleRegister':
        require '../controllers/LoginController.php';
        $controller = new LoginController();
        $controller->handleRegister();
        break;
    case 'showRegister':
        require '../controllers/LoginController.php';
        $controller = new LoginController();
        $controller->showRegister();
        break;
    case 'handleLogout':
        require '../controllers/LoginController.php';
        $controller = new LoginController();
        $controller->handleLogout();
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
        require '../controllers/HomepageController.php';
        $controller = new HomepageController();
        $controller->display();
        break;
}





?>