<?php

namespace Sanja\Controllers;

use Sanja\View\HtmlView;

require_once CONTROLLERS . 'AbstractController.php';
require_once CORE . 'View/HtmlView.php';

class IndexController extends AbstractController {
    public function indexAction() {

        return new HtmlView('index');
    }
}
