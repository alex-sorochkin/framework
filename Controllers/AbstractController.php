<?php

namespace Sanja\Controllers;

abstract class AbstractController {
    /**
     * @var mixed параметры из реквеста
     */
    protected $data;

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

    // @todo: запилить во всех контроллерах метод возврата их урлов
//    /**
//     * @return string URL контроллера
//     */
//    abstract static function getUrl();
}
