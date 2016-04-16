<?php

namespace Sanja\Core;

use ErrorException;
use Exception;
use Monolog\Formatter\ChromePHPFormatter;
use Monolog\Formatter\FlowdockFormatter;
use Monolog\Formatter\FluentdFormatter;
use Monolog\Formatter\GelfMessageFormatter;
use Monolog\Formatter\HtmlFormatter;
use Monolog\Formatter\LineFormatter;
use Monolog\Formatter\LogglyFormatter;
use Monolog\Formatter\LogstashFormatter;
use Monolog\Formatter\NormalizerFormatter;
use Monolog\Formatter\ScalarFormatter;
use Monolog\Formatter\WildfireFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Sanja\Core\Controller\AbstractController;
use Sanja\Controllers\ErrorController;
use Sanja\Core\View\AbstractView;
use Sanja\Core\View\HtmlView;

class Application {
    /**
     * @var Application синглтон аппликейшена
     */
    private static $Instance;

    /**
     * @var Request
     */
    private $Request;

    /**
     * @var Response
     */
    private $Response;

    /**
     * @var AbstractView
     */
    private $View;

    /**
     * @var Session
     */
    private $Session;

    public static function getInstance() {
        if (self::$Instance === null) {
            self::$Instance = new self;
        }
        return self::$Instance;
    }

    public function initialize() {
//        error_reporting(E_ALL ^ E_DEPRECATED ^ E_STRICT);
        set_error_handler([$this, 'fatalHandler']);
//        register_shutdown_function([$this, 'shutdownHandler']);

        /**
         * @todo: инициализация произойдет уже внутри, поэтому не надо ничего присваивать
         * но возможно, сделать вызов покрасивей
         */
        $this->getSession();

        $this->Request = $this->getRequest();
        $this->Response = $this->getResponse(); // @todo: задейстовать!!!
        $this->Request->extractParams();

        return $this;
    }

    public function run() {
        $Router = $this->Request->getRouter();
        $controller = $Router->prepareController();
        $action = $Router->prepareAction();

        try {
            /** @var AbstractController $ControllerClass */
            $ControllerClass = new $controller($this->Request, $this->Response);
            // @todo: сделать проверку возврата
            $ControllerClass->$action();

            // контроллер внутри себя должен менять состояние Response-а, обновим его явно
            $this->Response = $ControllerClass->getResponse();

            $this->View = AbstractView::create($this->getResponse());

            $this->View->setControllerName($Router->getController());
            $this->View->set($Router->getController());

            $this->View->render();
        } catch (Exception $Exception) {
            LoggerFactory::getLogger('Root')->addCritical($Exception);

            $ErrorController = new ErrorController($this->Request, $this->Response);
            $ErrorController->indexAction();
        }
    }

    public function finalize() {

    }

    public function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function fatalHandler($no, $str, $file, $line) {
        throw new ErrorException($str, 0, $no, $file, $line);
    }

    public function shutdownHandler()  {
//        require_once CONTROLLERS . 'ErrorController.php';
//        $ErrorController = new ErrorController();
//        $ErrorController->indexAction();


        $last_error = error_get_last();
        if ($last_error && $last_error['type']==E_ERROR)  {
//            header("HTTP/1.1 500 Internal Server Error");
            echo '...';//html for 500 page
        }
    }

    /**
     * @return Session
     */
    public function getSession() {
        if ($this->Session === null) {
            $this->Session = new Session();
        }

        return $this->Session;
    }

    /**
     * полагаю, этот вызов не должн понадобиться. но если будет нужен извне, то надо менять тут
     *
     * @param Session $Session
     *
     * @return $this
     */
    private function setSession($Session) {
        $this->Session = $Session;

        return $this;
    }

    /**
     * @return Request
     */
    public function getRequest() {
        if ($this->Request === null) {
            $this->Request = new Request();
        }

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
        if ($this->Response === null) {
            $this->Response = new Response();
        }
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
}
