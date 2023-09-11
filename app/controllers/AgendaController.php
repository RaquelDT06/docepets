<?php

namespace App\controllers;

use App\controllers\AuthController;
use Core\controller\Action;
use Core\model\Container;

use PDO;

session_start();


class AgendaController extends Action
{
    // public function cadastrar()
    // {

    //     AuthController::validaAutenticacao();
    //     $this->render("agendamento", "template_admin");
    // }

    public function cadastrar()
    {
        AuthController::validaAutenticacao();

        // Recupere o ID do usuário atual - substitua isso pelo código real para obter o ID do usuário
        $id_logado = '$id_usuario'; // Substitua pelo ID real do usuário logado

        // Obtenha a lista de pets do usuário
        $pets = $this->getPetsDoUsuario($id_logado);

        // Passe a lista de pets para a view
        $this->view->pets = $pets;

        $this->render("agendamento", "template_admin");
    }


    public function getPetsDoUsuario($id_logado)
    {
        
        $pets = array();

        return $pets;
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

        $agendamentos->__set('nasc_data', $_POST['nasc_data']);
        $agendamentos->__set('animal_tipo', $_POST['animal_tipo']);
        $agendamentos->__set('data_agend', $_POST['data_agend']);
        $agendamentos->__set('horario', $_POST['horario']);
        $agendamentos->__set('servicos', $_POST['servicos']);

        //valida campos

        if ($agendamentos->validarCadastro()) {
            if (count($agendamentos->getPets()) == 0) {

                $agendamentos->salvar();

                $this->view->status = array(
                    "status" => "SUCCESS",
                    "msg" => "Cadastro realizado com sucesso"
                );
                $this->render("salvar_agenda", "template_admin");
            } else {
                $this->view->status = array(
                    "status" => "ERROR",
                    "msg" => "Cadastro não realizado"
                );

                // salvar e permanecer dados
                $this->view->temagendamento = array(
                    'nasc_data', $_POST['nasc_data'],
                    'animal_tipo', $_POST['animal_tipo'],
                    'data_agend', $_POST['data_agend'],
                    'horario', $_POST["horario"],
                    'servicos', $_POST["servicos"],

                );

                $this->render("salvar_agenda", "template_admin");
            }
        } else {
            echo "Código do validar";
        }
    }
}
