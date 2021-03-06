<?php

namespace Sanja\Controllers;

use Sanja\Core\Application;
use Sanja\Core\Controller\AbstractController;
use Sanja\Core\View\HtmlView;

class LoginController extends AbstractController {
    const DEFAULT_LOGIN = 'test';
    const DEFAULT_PASSWORD = 'test';

//    public static function getUrl() {
//        return 'login';
//    }

    public function indexAction() {
        if (Application::getInstance()->isPost()) {
            $name = $this->get('username');
            $pass = $this->get('password');

            if ($name == self::DEFAULT_LOGIN && $pass == self::DEFAULT_PASSWORD) {
                Application::getInstance()->getSession()->logIn();
                Application::getInstance()->getResponse()->redirect('/index');
                return null;
            }
        }

        $View = new HtmlView('index');
        $View->setLayout('Simple');

        return $View;
    }
}
