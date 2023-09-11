<?php

namespace App;

use Core\init\Bootstrap;

class Route extends Bootstrap
{

    //array no qual iremos definir as rotas da nossa aplicação
    //toda rota dever ser inserida aqui
    protected function initRoutes()
    {

        //rotas das IndexController
        $routes['home'] =  array('route' => '/', 'controller' => 'IndexController', 'action' => 'index');
        $routes['contato'] =  array('route' => '/contato', 'controller' => 'IndexController', 'action' => 'contato');
        $routes['login'] = array('route' => '/login', 'controller' => 'IndexController', 'action' => 'login');
        $routes['quem_somos'] = array('route' => '/quem_somos', 'controller' => 'IndexController', 'action' => 'quem_somos');
        //rotas do ErrorController

        //rotas do AuthController
        $routes['autenticar'] = array('route' => '/autenticar', 'controller' => 'AuthController', 'action' => 'autenticar');
        $routes['sair'] = array('route' => '/sair', 'controller' => 'AuthController', 'action' => 'sair');

        //rotas do AdminController
        $routes['admin'] =  array('route' => '/admin', 'controller' => 'AdminController', 'action' => 'index');


        //rotas do UsuarioController
        $routes['usuario_novo'] =  array('route' => '/usuario_novo', 'controller' => 'UsuarioController', 'action' => 'cadastrar');
        $routes['salvar_usuario'] =  array('route' => '/salvar_usuario', 'controller' => 'UsuarioController', 'action' => 'salvar_usuario');

        //rotas do PetController
        $routes['cadastro_pet'] =  array('route' => '/cadastro_pet', 'controller' => 'PetController', 'action' => 'cadastro_pet');
        $routes['salvar_pet'] =  array('route' => '/salvar_pet', 'controller' => 'PetController', 'action' => 'salvar_pet');

        //rotas do AgendaController
        $routes['agendamento'] =  array('route' => '/agendamento', 'controller' => 'AgendaController', 'action' => 'cadastrar');
        $routes['salvar_agenda'] = array('route' => '/salvar_agenda', 'controller' => 'AgendaController', 'action' => 'salvar_agenda');

        $this->setRoutes($routes);
    }
}
