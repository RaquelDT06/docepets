<?php

namespace App\controllers;

use App\controllers\AuthController;
use Core\controller\Action;
use Core\model\Container;

// use Core\model\Container;

class AdminController extends Action
{
    public function index()
    {

        AuthController::validaAutenticacao();
        $agendamento = Container::getModel("Agenda");
        $agendamentos = $agendamento->getAgendamentos();

        $this->view->dados = $agendamentos;        
        
        $this->render("index", "template_admin");
    }
   
}

?>