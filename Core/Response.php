<?php

namespace Sanja\Core;

use Sanja\Core\View\AbstractView;

class Response {
    /**
     * @var string какого типа View
     */
    private $viewType;

    public function __construct() {
        $this->viewType = AbstractView::VIEW_TYPE_HTML;
    }

    public function redirect($location) {
        header('Location: ' . $location);
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