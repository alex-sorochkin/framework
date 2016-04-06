<?php

namespace Sanja\Core;

class Router {
    /** @var string $controller имя контроллера */
    private $controller;

    /** @var string $action имя экшена */
    private $action;

    /**
     * Router constructor.
     *
     * инициализация параметров значениями по умолчанию
     */
    public function __construct() {
        $this->controller = 'index';
        $this->action = 'index';
    }

    /**
     * подготовит и вернет полное имя класса-контроллера
     *
     * @return string
     */
    public function prepareController() {
        return CONTROLLERS_NAMESPACE . $this->getController() . 'Controller';
    }

    /**
     * подготовит и вернет полное имя метода-действия
     *
     * @return string
     */
    public function prepareAction() {
        return $this->getAction() . 'Action';
    }

    /**
     * @return string
     */
    public function getController() {
        return ucfirst($this->controller);
    }

    /**
     * @param string $controller
     *
     * @return $this
     */
    public function setController($controller) {
        $this->controller = $controller;

        return $this;
    }

    /**
     * @return string
     */
    public function getAction() {
        return ucfirst($this->action);
    }

    /**
     * @param string $action
     *
     * @return $this
     */
    public function setAction($action) {
        $this->action = $action;

        return $this;
    }
}
