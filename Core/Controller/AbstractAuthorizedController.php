<?php

namespace Sanja\Core\Controller;

use Sanja\Core\Application;
use Sanja\Core\Request;
use Sanja\Core\Response;

/**
 * контроллер, который проверяет авторизацию. сразу срезаем чуваков, которые не прошли логинку
 */
class AbstractAuthorizedController extends AbstractController {
    public function __construct(Request $Request, Response $Response) {
        parent::__construct($Request, $Response);

        if (!Application::getInstance()->getSession()->isLoggedIn()) {
            Application::getInstance()->getResponse()->redirect('/login');

            exit;
        }
    }
}
