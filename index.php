<?php

use Sanja\Core\Application;

define('ROOT', realpath(__DIR__) . '/');

define('CORE', ROOT . 'Core/');
define('CONTROLLERS', ROOT . 'Controllers/');
define('CONTROLLERS_NAMESPACE', 'Sanja\\Controllers\\');
define('VIEWS', ROOT . 'Views/');
define('ASSETS_DIR', ROOT . 'assets/');

require_once CORE . 'Application.php';
require_once CORE . 'Router.php';
require_once CORE . 'Session.php';

$Application = Application::getInstance();
$Application->initialize()->run();
