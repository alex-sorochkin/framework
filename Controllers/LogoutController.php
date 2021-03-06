<?php

namespace Sanja\Controllers;

use Sanja\Core\Application;
use Sanja\Core\Controller\AbstractAuthorizedController;

class LogoutController extends AbstractAuthorizedController {
    const DEFAULT_LOGIN = 'test';
    const DEFAULT_PASSWORD = 'test';

    public function indexAction() {
        Application::getInstance()->getSession()->logOut();
        Application::getInstance()->getResponse()->redirect('/index');
        return null;

    }
}
