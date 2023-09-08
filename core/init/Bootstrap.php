<?php

    namespace Core\init;

    abstract class Bootstrap {
        private $routes;
        
        abstract protected function initRoutes();

        
        public function __construct()
        {
           $this->initRoutes();
           $this->run($this->getUrl());
        }

        public function getRoutes() {
            return $this->routes;
        }

        public function setRoutes(array $routes) {
            $this->routes = $routes;
        }
        
        protected function getUrl() {
            
            return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }

        protected function run($url)
    {        
        $rota = array();

        foreach ($this->getRoutes() as $key => $route) {
            if ($url == $route['route']) {
                $class = "App\\controllers\\" . ucfirst($route['controller']);
                $action = $route['action'];

                $rota = array(
                    "classe" => $class,
                    "action" => $action,
                );
            }            
        }
        $this->loadView($rota);
    }

    public function loadView(array $rota)
    {
        if (!empty($rota)) {
            $controller = new $rota['classe'];
            $action = $rota['action'];
            $controller->$action();
        } else {
            // AuthController::validaAutenticacao();

            $class = "App\\controllers\\ErrorController";
            $controller = new $class;
            $action = "error404";
            $controller->$action();       
        }
    }

    }
?>