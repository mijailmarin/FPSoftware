<?php
use Slim\Container;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Slim\Views\PhpRenderer;
/** @var \Slim\App $app */
$container = $app->getContainer();

// Render php templates
$container['renderer'] = new PhpRenderer($settings['root'] . '/views');

// Activating routes in a subfolder
$container['environment'] = function () {
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $_SERVER['SCRIPT_NAME'] = dirname(dirname($scriptName)) . '/' . basename($scriptName);
    return new Slim\Http\Environment($_SERVER);
};

// Monolog logger entry
$container['logger'] = function (Container $container) {
    $settings = $container->get('settings');
    $logger = new Logger($settings['logger']['name']);    
    $level = $settings['logger']['level'];
    if (!isset($level)) {
        $level = Logger::ERROR;
    }    
    $logFile = $settings['logger']['file'];
    $handler = new RotatingFileHandler($logFile, 0, $level, true, 0775);
    $logger->pushHandler($handler);    
    return $logger;
};