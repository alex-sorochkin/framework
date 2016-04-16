<?php

namespace Sanja\Core\View;

class HtmlView extends AbstractView {
    /**
     * @param string $viewName
     * @param bool   $useLayout
     */
    public function __construct($viewName, $useLayout = true) {
        $this->layout = 'Main';

        $this->viewName = $viewName;
        $this->useLayout = $useLayout;
    }

    /**
     * @inheritdoc
     */
    public function render() {
        if ($this->isUseLayout()) {
            require_once
                VIEWS .
                ucfirst($this->getLayoutDir()) . '/' .
                ucfirst($this->getLayout()) . '/Layout.phtml';
        } else {
            // @todo: реализовать частичный рендеринг без лайаута
            throw new \Exception('partial rendering is not implemented yet');
        }
    }
}
