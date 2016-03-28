<?php

namespace Sanja\Controllers;

use Sanja\Core\Application;

require_once CONTROLLERS . 'AbstractController.php';

/**
 * контроллер, который проверяет авторизацию. сразу срезаем чуваков, которые не прошли логинку
 */
class AbstractAuthorizedController extends AbstractController {
    public function __construct() {
        if (!Application::getInstance()->getSession()->isLoggedIn()) {
            Application::getInstance()->getRouter()->redirect('/login');

            exit;
        }
    }
}
