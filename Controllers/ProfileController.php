<?php

namespace Sanja\Controllers;

use Sanja\Core\Controller\AbstractAuthorizedController;

/**
 * контроллер, который проверяет авторизацию. сразу срезаем чуваков, которые не прошли логинку
 */
class ProfileController extends AbstractAuthorizedController {
    public function IndexAction() {
        var_dump('qwe asd');
    }
}
