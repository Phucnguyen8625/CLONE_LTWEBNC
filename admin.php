<?php
// Simple Router for Admin Categories

require_once __DIR__ . '/controllers/AdminCategoryController.php';
require_once __DIR__ . '/controllers/AdminComicController.php';
require_once __DIR__ . '/controllers/AdminOrderController.php';
require_once __DIR__ . '/controllers/AdminPaymentController.php';
require_once __DIR__ . '/controllers/AdminReportController.php';

$controllerType = isset($_GET['controller']) ? $_GET['controller'] : 'category';

if ($controllerType == 'comic') {
    $controller = new AdminComicController();
} else if ($controllerType == 'order') {
    $controller = new AdminOrderController();
} else if ($controllerType == 'payment') {
    $controller = new AdminPaymentController();
} else if ($controllerType == 'report') {
    $controller = new AdminReportController();
} else {
    $controller = new AdminCategoryController();
}

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    $controller->index();
}
?>
