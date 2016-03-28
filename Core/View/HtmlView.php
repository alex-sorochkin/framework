<?php

namespace Sanja\View;

require_once 'AbstractView.php';

class HtmlView extends AbstractView {
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
