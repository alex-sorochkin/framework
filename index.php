<?php

use Sanja\Core\Application;
use Sanja\Core\Autoloader;

define('ROOT', realpath(__DIR__) . '/');

define('CORE', ROOT . 'Core/');
define('CONTROLLERS', ROOT . 'Controllers/');
define('SANJA_NAMESPACE', 'Sanja');
define('CONTROLLERS_NAMESPACE', 'Sanja\\Controllers\\');
define('VIEWS', ROOT . 'Views/');
define('ASSETS_DIR', ROOT . 'assets/');
define('LOGS_DIR', ROOT . 'log/');
define('VENDOR_DIR', ROOT . 'vendor/');

require_once VENDOR_DIR . 'autoload.php';
require_once CORE . 'Autoloader.php';
Autoloader::register();

$Application = Application::getInstance();
$Application->initialize()->run();
