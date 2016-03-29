<?php

namespace Sanja\Controllers;

use Sanja\Core\View\HtmlView;

class IndexController extends AbstractController {
    public function indexAction() {

        return new HtmlView('index');
    }
}
