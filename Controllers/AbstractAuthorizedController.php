<?php

namespace Sanja\Controllers;

use Sanja\Core\Application;

/**
 * контроллер, который проверяет авторизацию. сразу срезаем чуваков, которые не прошли логинку
 */
class AbstractAuthorizedController extends AbstractController {
    public function __construct() {
        if (!Application::getInstance()->getSession()->isLoggedIn()) {
            Application::getInstance()->getResponse()->redirect('/login');

            exit;
        }
    }
}
