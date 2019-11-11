<?php

namespace Core;

use Util\Logger;

class Route
{
    private $routes;

    public function __construct(array $routes)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "Routes instantiated.");
        $this->setRoutes($routes);
        $this->run();
    }

    private function setRoutes($routes)
    {
        foreach ($routes as $route){
            $explode = explode('@', $route[1]);
            if(isset($route[2])){
                $r = [$route[0], $explode[0], $explode[1], $route[2]];
            }else{
                $r = [$route[0], $explode[0], $explode[1]];
            }
            $newRoutes[] = $r;
        }
        $this->routes = $newRoutes;
    }

    private function getRequest()
    {
        $requestObject = new \stdClass;
        Logger::log_message(Logger::LOG_INFORMATION, "Getting request...");
        foreach ($_GET as $key => $value){
            @$requestObject->get->$key = $value;
            Logger::log_message(Logger::LOG_INFORMATION, "REQUEST (GET): $key => $value");
        }

        foreach ($_POST as $key => $value){
            @$requestObject->post->$key = $value;
            Logger::log_message(Logger::LOG_INFORMATION, "REQUEST (POST): $key => $value");
        }

        return $requestObject;
    }

    private function getUrl()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "Getting URL " . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    private function run()
    {
        $url = $this->getUrl();
        $urlArray = explode('/', $url);

        foreach ($this->routes as $route) {
            $routeArray = explode('/', $route[0]);
            $param = [];
            for($i = 0; $i < count($routeArray); $i++){
                if((strpos($routeArray[$i], "{") !==false) && (count($urlArray) == count($routeArray))){
                    $routeArray[$i] = $urlArray[$i];
                    $param[] = $urlArray[$i];
                }
                $route[0] = implode($routeArray, '/');
            }

            if($url == $route[0]){
                $found = true;
                $controller = $route[1];
                $action = $route[2];
                Logger::log_message(Logger::LOG_SUCCESS, "Controller found: $controller");
                Logger::log_message(Logger::LOG_SUCCESS, "Action found: $action");
                //$auth = new Auth;
                //if(isset($route[3]) && $route[3] == 'auth' && !$auth->check()){
                  //  $action = 'forbiden';
               // }
                break;
            }
        }

        if(isset($found)){
            $controller = Container::getControllerInstance($controller);
            switch (count($param)){
                case 1:
                    $controller->$action($param[0], $this->getRequest());
                    break;
                case 2:
                    $controller->$action($param[0], $param[1], $this->getRequest());
                    break;
                case 3:
                    $controller->$action($param[0], $param[1], $param[2], $this->getRequest());
                    break;
                default:
                    $controller->$action($this->getRequest());
                    break;
            }
        }else{
            Logger::log_message(Logger::LOG_ERROR, "Invalid route. Returning 404 exception.");
            Container::Exception404();
        }
    }

}
