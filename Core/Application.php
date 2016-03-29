<?php

namespace Sanja\Core;

use ErrorException;
use Exception;
use Sanja\Controllers\AbstractController;
use Sanja\Core\View\AbstractView;

class Application {
    /**
     * @var Application синглтон аппликейшена
     */
    private static $Instance;

    /**
     * @var Router
     */
    private $Router;

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
        require_once CORE . 'Autoloader.php';
        Autoloader::register();

//        error_reporting(E_ALL ^ E_DEPRECATED ^ E_STRICT);
        set_error_handler([$this, 'fatalHandler']);
//        register_shutdown_function([$this, 'shutdownHandler']);

        /**
         * @todo: инициализация произойдет уже внутри, поэтому не надо ничего присваивать
         * но возможно, сделать вызов покрасивей
         */
        $this->getSession();

        $this->Router = $this->getRouter();
        $this->getRouter()->extractParams();

        return $this;
    }

    public function run() {
        $controller = ucfirst($this->getRouter()->getController());
        $action = strtolower($this->getRouter()->getAction());

        $controllerName = $controller . 'Controller';
        $actionName = $action . 'Action';

        $fullClassName = CONTROLLERS_NAMESPACE . $controllerName;

        try {
            require_once CONTROLLERS . $controllerName . '.php';

            /** @var AbstractController $ControllerClass */
            $ControllerClass = new $fullClassName();
            $ControllerClass->setData($this->getRouter()->getParams());
            $this->View = $ControllerClass->$actionName();
            if ($this->View !== null) {
                $this->View->setControllerName($controller);
                $this->View->render();
            }
        } catch (Exception $Exception) {
            $ErrorController = new ErrorController();
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
     * @return Router
     */
    public function getRouter() {
        if ($this->Router === null) {
            $this->Router = new Router();
        }

        return $this->Router;
    }

    /**
     * @param Router $Router
     *
     * @return $this
     */
    public function setRouter($Router) {
        $this->Router = $Router;

        return $this;
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
}
