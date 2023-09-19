<?php

namespace App\controllers;


use App\controllers\AuthController;
use Core\controller\Action;
use Core\model\Container;

use PDO;

session_start();


class AgendaController extends Action
{
    public function cadastrar()
    {

        AuthController::validaAutenticacao();
        $this->render("agendamento", "template_admin");
    }



    public function salvar_agenda()
    {

        // dd($_POST);

        //istancia
        $agendamentos = Container::getModel("Agenda");

        if (!isset($_SESSION['id_agendamento'])) {
            // Nao logado
        }


        //recebe dados

        $agendamentos->__set('data_agend', $_POST['data_agend']);
        $agendamentos->__set('horario', $_POST['horario']);
        $agendamentos->__set('usuario_id', $_POST['usuario_id']);
        $agendamentos->__set('pet_id', $_POST['pet_id']);
        $agendamentos->__set('servicos', $_POST['servicos']);

        // dd($agendamentos);
        //valida campos



        $agendamentos->salvar();

        $this->view->status = array(
            "status" => "SUCCESS",
            "msg" => "Cadastro realizado com sucesso"
        );
        $this->render("agendamento", "template_admin");
    }

    public function atualizar_agenda()
    {
        $agendamentos = Container::getModel("Agenda");

        $agendamentos->__set('data_agend', $_GET['data_agend']);
        $agendamentos->__set('horario', $_GET['horario']);
        $agendamentos->__set('usuario_id', $_GET['usuario_id']);
        $agendamentos->__set('pet_id', $_GET['pet_id']);
        $agendamentos->__set('servicos', $_GET['servicos']);

        $agendamentos->atualizar();

        $this->view->status = array(
            "status" => "SUCCESS",
            "msg" => "Realizado com sucesso"
        );
        $this->render("agendamento", "template_admin");
        
    }
}
