<?php

namespace Sanja\Core\View;
use Sanja\Core\Request;
use Sanja\Core\Response;

/**
 * абстрактный класс вьюхи
 * конкретное поведение того, что надо куда-то отдавать, надо реализовывать в наследниках
 *
 * @todo: подумать, как все это отдавать и чем возвращать
 * @todo: подумать, как это вообще все парсить. на чистом, или использовать какой-то шаблонизатор
 */
abstract class AbstractView {
    const VIEW_TYPE_HTML = 'html';
    const VIEW_TYPE_JSON = 'json';

    /**
     * @var mixed[] любые параметры в виде ассоциативного массива, которые можно устанавливать в ходе работы контроллера
     */
    protected $params;

    /**
     * @var string
     * имя части пути по имени контроллера
     * ОБЯЗАТЕЛЬНО должно совпадать с именем контроллера, такова будет у нас идеология
     */
    protected $controllerName;

    /**
     *  @todo: сейчас удобней возращать полностью сформированную вью из контроллера, и пока не понятно,
     * будет ли этим и дальше заниматься контроллер. или лучше полностью переложить на Апп
     */
//    public static function create(Request $Request) {
//        $View = null;
//        switch ($Request->getViewType()) {
//            case AbstractView::VIEW_TYPE_HTML:
//                $View = new HtmlView($Request->getRouter()->getAction());
//                break;
//            case AbstractView::VIEW_TYPE_JSON:
//                $View = new JsonView();
//                break;
//        }
//
//        return $View;
//    }

    /**
     * абстрактная функция рендеринга вьюхи
     *
     * поскольку вьюха может не только показывать котиков в браузере,
     * определять, что делать, будет каждый конкретный наследник данного класса
     */
    abstract public function render();

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
}
