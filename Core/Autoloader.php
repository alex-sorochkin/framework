<?php

namespace Sanja\Core;

use Sanja\Core\Exception\FileDoesNotExistsException;

class Autoloader {
    public static function register() {
        spl_autoload_register([new self(), 'autoload']);
    }

    public function autoload($className) {
        $nameParts = explode('\\', $className);
        // подключаем классы только из собственного неймспейса
        if ($nameParts[0] !== SANJA_NAMESPACE) {
            return;
        }

        unset($nameParts[0]);
        $newClassName = ROOT . implode('/', $nameParts) . '.php';
        if (!file_exists($newClassName)) {
            throw new FileDoesNotExistsException(sprintf(
                'Не могу подключить файл [%s]: файл не существует',
                $newClassName
            ));
        }

        require_once $newClassName;
    }
}
