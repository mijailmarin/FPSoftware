<?php
# Debug (E_All=dev | 0=prod)
error_reporting(E_ALL);
# Sesiones
session_start();
# Dependencies autoloader
require __DIR__ . '/../../vendor/autoload.php';
# Instantiate the app
$app = new \Slim\App(['settings' => require __DIR__ . '/settings.php']);
# Set up dependencies
require  __DIR__ . '/container.php';
# Register middleware
require __DIR__ . '/middleware.php';
# Register routes
require __DIR__ . '/routes.php';

return $app;