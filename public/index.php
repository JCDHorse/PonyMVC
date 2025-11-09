<?php

require_once __DIR__ . '/../src/core/loader.php';

use controllers\HomeController;

// Test database access
$pdo = null;
try {
    $pdo = new PDO('mysql:host=db;port=3306;dbname=ponymvc',
        'pony',
        'ponypass',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (PDOException $e) {
    die(json_encode(array('outcome' => false, 'message' => $e->getMessage())));
}

\models\ModelFactory::init($pdo);

$routes = [
    'GET' => [
        '/' => [HomeController::class, 'getIndex'],
    ],
];

$url = $_GET['url'] ?? '/';
$method = $_SERVER["REQUEST_METHOD"];

$controllerClass = $routes[$method][$url][0] ?? null;
$handlerMethod = $routes[$method][$url][1] ?? null;

if (!$controllerClass || !$handlerMethod) {
    http_response_code(404);
    echo "404 Not Found";
    exit;
}

$controller = new $controllerClass;

call_user_func([$controller, $handlerMethod]);

