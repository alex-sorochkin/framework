<?php

namespace Sanja\Core;

/**
 * класс работы с сессией
 *
 * @todo:
 * сейчас конкретно не до нее, да и юзер у нас пока единственный
 * тем не менее, без сессии логинку не сделать
 * поэтому на данном этапа сессия будет хранить единственный параметр от том, залогинен юзер или нет
 * без привязки к ИД, логинам и прочему. просто показываем мы ему что-то дальше или нет
 *
 */
class Session {
    /**
     * инициализация сессии
     */
    public function __construct() {
        session_start();
    }

    /**
     * проверка залогиненности
     * @todo: учесть для разных юзеров
     *
     * @return bool
     */
    public function isLoggedIn() {
        return
            isset($_SESSION) &&
            isset($_SESSION['is_logged_in']) &&
            $_SESSION['is_logged_in'] == true;
    }

    /**
     * залогинить чувака
     * @todo: учесть для разных юзеров
     */
    public function logIn() {
        $_SESSION['is_logged_in'] = true;
    }

    /**
     * разлогинить чувака
     * @todo: учесть для разных юзеров
     */
    public function logOut() {
        unset($_SESSION['is_logged_in']);
    }
}
