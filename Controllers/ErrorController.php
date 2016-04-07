<?php

namespace Sanja\Controllers;

use Sanja\Core\Controller\AbstractController;

class ErrorController extends AbstractController {
    public function indexAction() {
        echo 'this is error page';
    }
}
