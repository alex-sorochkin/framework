<?php

namespace Sanja\Core;

class Request {
    /** @var array $params массив переданных параметров */
    private $params;

    /**
     * @var Router
     */
    private $Router;

    public function __construct() {
        $this->params = [];
    }

    /**
     * разбираем GET из запроса и складываем в переменные
     */
    public function extractParams() {
        $query = trim($_GET['q'], "\t\r\n\0\x0B\/"); // ОБЯЗАТЕЛЬНО двойные кавычки!!!
        $parts = explode('/', $query);

        if (!empty($parts[0])) {
            $this->getRouter()->setController($parts[0]);
        }

        if (!empty($parts[1])) {
            $this->getRouter()->setAction($parts[1]);
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
     * @return Router
     */
    public function getRouter() {
        if ($this->Router === null) {
            $this->Router = new Router();
        }

        return $this->Router;
    }

    /**
     * @param Router $Router
     *
     * @return $this
     */
    public function setRouter($Router) {
        $this->Router = $Router;

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
}