<?php
/** 
 * Author: https://www.github.com/fernandocalmet
 * Configuration App
 * 
 * [Autoload classes]
 * cmd: composer dump-autoload
 * [Production changes]
 * cmd: composer update --no-dev --optimized-autoloader
 * $settings['displayErrorDetails'] = false;
 *
 * @var $config['displayErrorDetails'] to display error details on slim
 * @var $config['addContentLengthHeader'] should be set to false. This will allows the web server to set the Content-Length header which makes Slim behave more predictably
 * @var $config['limitLoadData'] to protect high request data load. Default is 1000.
 * @var $config['enableApiKeys'] to protect api from guest or anonymous. Guest which don't have api key can not using this service. Default is true.
 * @var $config['language'] is language that we use for delivery message information. Default is en means english.
 * @var $config['httpVersion'] The protocol version used by the Response object. Default is '1.1'. 
 * @var $config['responseChunkSize'] Size of each chunk read from the Response body when sending to the browser. Default is 4096
 * @var $config['outputBuffering'] If false, then no output buffering is enabled. If 'append' or 'prepend', then any echo or print statements are captured and are either appended or prepended to the Response returned from the route callable. Default is 'append'
 * @var $config['determineRouteBeforeAppMiddleware'] When true, the route is calculated before any middleware is executed. This means that you can inspect route parameters in middleware if you need to. Default is false.
 */
$settings = [];
$settings['displayErrorDetails'] = true;
$settings['addContentLengthHeader'] = false;
$settings['limitLoadData'] = 1000;
$settings['enableApiKeys'] = true;
$settings['language'] = 'en';
$settings['httpVersion'] = '1.1';
$settings['responseChunkSize'] = 4096;
$settings['outputBuffering'] = 'append';
$settings['determineRouteBeforeAppMiddleware'] = true;

// PATH SETTINGS
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/temp';
$settings['public'] = $settings['root'] . '/public';

// LOGGER SETTINGS
$settings['logger'] = [
    'name' => 'app',
    'file' => $settings['temp'] . '/logs/app.log',
    'level' => \Monolog\Logger::ERROR,
];

return $settings;