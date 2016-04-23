<?php

namespace Sanja\Core\View;

class HtmlView extends AbstractView {
    /**
     * @var string имя лайаута
     */
    protected $layout;

    /**
     * @var string
     * имя вьюхи, которую будем рендерить
     * вьюху можно достать только из папки по имени контроллера
     * желательно, чтобы имя совпадало с именем экшена, но это не принципиально, эти имена могут и не совпадать
     */
    protected $viewName;

    /**
     * @var bool
     */
    protected $useLayout;

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

    protected function renderContent() {
        require VIEWS . $this->getControllerName() . '/' . ucfirst($this->getViewName()) . '.phtml';
    }

    protected function renderLayoutPart($partName) {
        require VIEWS . $this->getLayoutDir() . '/' . $this->getLayout() . '/' . ucfirst($partName) . '.phtml';
    }

    /**
     * Получить имя каталога с лайаутами
     *
     * @return string
     */
    public function getLayoutDir() {
        return 'Layouts';
    }

    /**
     * @return string
     */
    public function getLayout() {
        return $this->layout;
    }

    /**
     * @param string $layout
     *
     * @return $this
     */
    public function setLayout($layout) {
        $this->layout = $layout;

        return $this;
    }

    /**
     * @return string
     */
    public function getViewName() {
        return $this->viewName;
    }

    /**
     * @param string $viewName
     *
     * @return $this
     */
    public function setViewName($viewName) {
        $this->viewName = $viewName;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isUseLayout() {
        return $this->useLayout;
    }

    /**
     * @param boolean $useLayout
     *
     * @return $this
     */
    public function setUseLayout($useLayout) {
        $this->useLayout = $useLayout;

        return $this;
    }
}
