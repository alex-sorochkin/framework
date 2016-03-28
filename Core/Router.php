<?php

namespace Sanja\Core;

class Router {
    /** @var string $controller имя контроллера */
    private $controller;

    /** @var string $action имя экшена */
    private $action;

    /** @var array $params массив переданных параметров */
    private $params;

    /**
     * Router constructor.
     *
     * инициализация параметров значениями по умолчанию
     */
    public function __construct() {
        $this->controller = 'index';
        $this->action = 'index';
        $this->params = [];
    }

    /**
     * разбираем GET из запроса и складываем в переменные
     */
    public function extractParams() {
        $query = trim($_GET['q'], "\t\r\n\0\x0B\/"); // ОБЯЗАТЕЛЬНО двойные кавычки!!!
        $parts = explode('/', $query);

        if (!empty($parts[0])) {
            $this->controller = $parts[0];
        }

        if (!empty($parts[1])) {
            $this->action = $parts[1];
        }

        if (count($parts) > 2) {
            $parts = array_slice($parts, 2);

            while ($key = array_shift($parts)) {
                $value = array_shift($parts);

                $this->params[$key] = $value;
            }
        }

        if (!empty($_POST)) {
            foreach ($_POST as $key => $item) {
                $this->params[$key] = $item;
            }
        }
    }

    /**
     * @return string
     */
    public function getController() {
        return $this->controller;
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
        return $this->action;
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

    /**
     * @return array
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * @param array $params
     *
     * @return $this
     */
    public function setParams($params) {
        $this->params = $params;

        return $this;
    }

    public function redirect($location) {
        header('Location: ' . $location);
    }
}
