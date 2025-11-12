<?php
namespace core;

function require_file($relativePath): void {
    static $baseDir = __DIR__ . '/../../';
    require_once $baseDir . $relativePath;
}

$files = [
    'src/core/Router.php',
    'src/models/Model.php',
    'src/models/ModelFactory.php',
    'src/models/PonyImg.php',
    'src/controllers/Controller.php',
    'src/controllers/ControllerResponse.php',
    'src/controllers/HomeController.php',
    'src/controllers/PonyController.php',
    'src/controllers/ErrorController.php',
    'src/views/View.php',
    'src/views/HomeView.php',
    'src/views/PonyView.php',
    'src/views/ErrorView.php',
];


foreach ($files as $file) {
    require_file($file);
}
