<?php

namespace Sanja\Core\Controller;

use Sanja\Core\Request;
use Sanja\Core\Response;

abstract class AbstractController {
    /**
     * @var Request
     */
    protected $Request;

    /**
     * @var Response
     */
    protected $Response;

    /**
     * @var mixed параметры из реквеста
     */
    protected $data;

    /**
     * AbstractController constructor.
     * @param Request $Request
     * @param Response $Response
     */
    public function __construct(Request $Request, Response $Response) {
        $this->Request = $Request;
        $this->Response = $Response;

        $this->setData($Request->getParams());
    }

    /**
     * получить нужный элемент из параметров реквеста по ключу. при отсутствии вернет $default
     *
     * @param string $key    запрашиваемый параметр
     * @param null $default  значение по умолчанию, если параметр не найден
     *
     * @return mixed|null
     */
    public function get($key, $default = null) {
        return isset($this->data[$key]) ? $this->data[$key] : $default;
    }

    /**
     * @return mixed
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @param mixed $data
     *
     * @return $this
     */
    public function setData($data) {
        $this->data = $data;

        return $this;
    }

    /**
     * @return Request
     */
    public function getRequest() {
        return $this->Request;
    }

    /**
     * @param Request $Request
     *
     * @return $this
     */
    public function setRequest($Request) {
        $this->Request = $Request;

        return $this;
    }

    /**
     * @return Response
     */
    public function getResponse() {
        return $this->Response;
    }

    /**
     * @param Response $Response
     *
     * @return $this
     */
    public function setResponse($Response) {
        $this->Response = $Response;

        return $this;
    }

    // @todo: запилить во всех контроллерах метод возврата их урлов
//    /**
//     * @return string URL контроллера
//     */
//    abstract static function getUrl();
}
