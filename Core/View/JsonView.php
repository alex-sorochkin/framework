<?php

namespace Sanja\Core\View;

class JsonView extends AbstractView {
    /**
     * @inheritdoc
     */
    public function render() {
        echo json_encode($this->getParams());
    }
}
