<?php
    
    namespace App;

    use Core\init\Bootstrap;

    class Route extends Bootstrap{
       
        //array no qual iremos definir as rotas da nossa aplicação
        //toda rota dever ser inserida aqui
        protected function initRoutes() {

            //rotas das IndexController
            $routes['home'] =  array('route'=>'/','controller'=>'IndexController','action'=>'index');
            $routes['contato'] =  array('route'=>'/contato','controller'=>'IndexController','action'=>'contato');
            $routes['login'] = array('route'=>'/login', 'controller' => 'IndexController', 'action' => 'login');
            $routes['nossas_lojas'] = array('route'=>'/nossas_lojas', 'controller' => 'IndexController', 'action' => 'nossas_lojas');

            //rotas do ErrorController

            //rotas do AuthController
            $routes['autenticar'] = array('route'=>'/autenticar', 'controller' => 'AuthController', 'action' => 'autenticar');

            $routes['sair'] = array('route'=>'/sair', 'controller' => 'AuthController', 'action' => 'sair');

            //rotas do AdminController
            $routes['admin'] =  array('route'=>'/admin','controller'=>'AdminController','action'=>'index');
            

            //rotas do UsuarioController
            $routes['usuario_novo'] =  array('route'=>'/usuario_novo','controller'=>'UsuarioController','action'=>'cadastrar');

            $routes['salvar_usuario'] =  array('route'=>'/salvar_usuario','controller'=>'UsuarioController','action'=>'salvar_usuario');
            

            $this->setRoutes($routes);
        }

        
    }

?>