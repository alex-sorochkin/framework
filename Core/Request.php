<?php

namespace Sanja\Core;

class Request {
    /**
     * @var Router
     */
    private $Router;

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
}