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

        dd($_POST);

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

        //valida campos

        if ($agendamentos->validarCadastro()) {
            if (count($agendamentos->getPets()) == 0) {

                $agendamentos->salvar();

                $this->view->status = array(
                    "status" => "SUCCESS",
                    "msg" => "Cadastro realizado com sucesso"
                );
                $this->render("agendamento", "template_admin");
            } else {
                $this->view->status = array(
                    "status" => "ERROR",
                    "msg" => "Cadastro não realizado"
                );

                // salvar e permanecer dados
                $this->view->temagendamento = array(
                    
                    'data_agend', $_POST['data_agend'],
                    'horario', $_POST["horario"],
                    'usuario_id', $_POST["usuario_id"],
                    'pet_id', $_POST["pet_id"],
                    'servicos', $_POST["servicos"],

                );

                $this->render("agendamento", "template_admin");
            }
        } else {
            echo "Código do validar";
        }
    }
}
