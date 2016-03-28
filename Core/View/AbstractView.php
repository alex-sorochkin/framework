<?php

namespace Sanja\View;

/**
 * абстрактный класс вьюхи
 * конкретное поведение того, что надо куда-то отдавать, надо реализовывать в наследниках
 *
 * @todo: подумать, как все это отдавать и чем возвращать
 * @todo: подумать, как это вообще все парсить. на чистом, или использовать какой-то шаблонизатор
 */
abstract class AbstractView {
    /**
     * @var mixed[] любые параметры в виде ассоциативного массива, которые можно устанавливать в ходе работы контроллера
     */
    protected $params;

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
     * @var string
     * имя части пути по имени контроллера
     * ОБЯЗАТЕЛЬНО должно совпадать с именем контроллера, такова будет у нас идеология
     */
    protected $controllerName;

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
     * абстрактная функция рендеринга вьюхи
     *
     * поскольку вьюха может не только показывать котиков в браузере,
     * определять, что делать, будет каждый конкретный наследник данного класса
     */
    abstract public function render();

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
     * @return mixed[]
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * @param mixed[] $params
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
     * @return string
     */
    public function getControllerName() {
        return $this->controllerName;
    }

    /**
     * @param string $controllerName
     *
     * @return $this
     */
    public function setControllerName($controllerName) {
        $this->controllerName = $controllerName;

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
