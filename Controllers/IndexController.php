<?php

namespace Sanja\Controllers;

use Sanja\Core\Controller\AbstractController;
use Sanja\Core\View\HtmlView;

class IndexController extends AbstractController {
    public function indexAction() {

        $View = new HtmlView('index');

        return $View;
    }
}
