<?php

function require_file($relativePath): void {
    static $baseDir = __DIR__ . '/../../';
    require_once $baseDir . $relativePath;
}

$files = [
    'src/models/Model.php',
    'src/models/ModelFactory.php',
    'src/models/PonyImg.php',
    'src/controllers/Controller.php',
    'src/controllers/HomeController.php',
    'src/views/View.php',
    'src/views/HomeView.php',
    'src/views/PonyView.php',
];


foreach ($files as $file) {
    require_file($file);
}
