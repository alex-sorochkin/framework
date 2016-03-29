<?php

namespace Sanja\Core;

class Autoloader {
    public static function register() {
        spl_autoload_register([new self(), 'autoload']);
    }

    public function autoload($className) {
        $nameParts = explode('\\', $className);
        unset($nameParts[0]);
        $newClassName = ROOT . implode('/', $nameParts) . '.php';
        if (!file_exists($newClassName)) {
            throw new \Exception(sprintf('Не могу подключить файл [%s]: файл не существует', $newClassName));
        }

        require_once $newClassName;
    }
}
