<?php

namespace Sanja\Controllers;

use Sanja\Core\Application;

require_once CONTROLLERS . 'AbstractAuthorizedController.php';
require_once CORE . 'View/HtmlView.php';

class LogoutController extends AbstractAuthorizedController {
    const DEFAULT_LOGIN = 'test';
    const DEFAULT_PASSWORD = 'test';

    public function indexAction() {
        Application::getInstance()->getSession()->logOut();
        Application::getInstance()->getRouter()->redirect('/index');
        return null;

    }
}
