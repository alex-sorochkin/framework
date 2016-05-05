<?php

namespace Sanja\Core;

use Sanja\Core\View\AbstractView;

class Request {
    /** @var array $params массив переданных параметров */
    private $params;

    /** @var string $viewType какого типа у нас будет отдаваться VIEW */
    private $viewType;

    /**
     * @var Router
     */
    private $Router;

    public function __construct() {
        $this->params = [];
        $this->viewType = AbstractView::VIEW_TYPE_HTML;
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

        // попробуем определить тип View тут. @todo: проверить, что с POST тоже будет работать
        // будем считать .json отдельным признаком, в остальных случаях это html
        // остальные ситуации будут требовать отдельных реализаций
        if (preg_match('|\.json|', $_SERVER['REQUEST_URI'])) {
            $this->viewType = AbstractView::VIEW_TYPE_JSON;
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

    /**
     * @return string
     */
    public function getViewType() {
        return $this->viewType;
    }

    /**
     * @param string $viewType
     *
     * @return $this
     */
    public function setViewType($viewType) {
        $this->viewType = $viewType;

        return $this;
    }
}
