<?php

namespace CS;
// CS - Chathura Sandeepa ;-)

/**
 * Class Application
 * @package CS
 * @author Chathura Sandeepa <chathuras@gmail.com>
 */
class Application {

    public function __construct($environment, $configs)
    {
        require_once 'Autoloader.php';

        $autoloader = new Autoloader();
        $autoloader->register();

        $configs = require_once $configs;

        Config::setConfigs($configs[$environment]);
    }

    /**
     * Starting the app, Dispatching controller and action, setting view
     */
    public function start() {
        $params = explode('/', $_SERVER['REQUEST_URI']);
        array_shift($params);

        $controllerName = 'Index';
        $actionName = 'index';

        if (!empty($params[0])) {
            $controllerName = array_shift($params);
        }

        if (!empty($params[0])) {
            $actionName = array_shift($params);
        }

        $controllerFullName = 'App_Controller_' . ucfirst($controllerName) . 'Controller';
        $actionFullName = $actionName . 'Action';

        $controller = new $controllerFullName();
        $controller->view = new View(strtolower($controllerName), strtolower($actionName));

        $controller->$actionFullName();
    }
}
