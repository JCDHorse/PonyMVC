<?php

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * TODO: Add logging, environment variables, etc.
 */

// Test database access
$pdo = null;
try {
    $pdo = new PDO('mysql:host=db;port=3306;dbname=ponymvc',
        'pony',
        'ponypass',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    // If we can't cnnect to the database, return a JSON error message and stop execution
    die(json_encode(array('outcome' => false, 'message' => $e->getMessage())));
}

\PonyMVC\models\ModelFactory::init($pdo);

$url = $_GET['url'] ?? '/';
$method = $_SERVER["REQUEST_METHOD"];

$homeController = new \PonyMVC\controllers\HomeController();
$ponyController = new \PonyMVC\controllers\PonyController();

$router = new \PonyMVC\core\Router(new \PonyMVC\controllers\ErrorController());
$router->addRoute("GET", "/", [$homeController, 'getIndex']);
$router->addRoute("GET", "/pony/{id}", [$ponyController, 'getPony']);
$router->addRoute("POST", "/pony", [$ponyController, 'newPony']);
$router->addRoute("DELETE", "/pony/{id}", [$ponyController, 'deletePony']);


$response = $router->dispatch($method, $url);
if ($response->getResponseCode() >= 300 && $response->getResponseCode() < 400) {
    header("Location: {$response->getResponse()}");
    return;
}
http_response_code($response->getResponseCode());
echo $response->getResponse();

