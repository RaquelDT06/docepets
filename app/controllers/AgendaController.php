<?php

namespace App\controllers;

use App\controllers\AuthController;
use Core\controller\Action;
use Core\model\Container;

// use Core\model\Container;

class PetController extends Action
{
    public function cadastrar()
    {

        AuthController::validaAutenticacao();
        $this->render("cadastrar", "template_admin");
    }

    public function salvar_pet()
    {

        // dd($_POST);

        //istancia
        $agendamentos = Container::getModel("Agendamento");

        //recebe dados
      
        $agendamentos->__set('nasc_data', $_POST['nasc_data']);
        $agendamentos->__set('animal_tipo', $_POST['animal_tipo']);
        $agendamentos->__set('data_agend', $_POST['data_agend']);
        $agendamentos->__set('horario', $_POST["horario"]);

        //valida campos

        if ($agendamentos->validarCadastro()) {
            if (count($agendamentos->getAgendamento()) == 0) {

                $agendamentos->salvar();

                $this->view->status = array(
                    "status" => "SUCCESS",
                    "msg" => "Cadastro realizado com sucesso"
                );
                $this->render("cadastrar", "template_admin");
                
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

                ); 

                $this->render("cadastrar", "template_admin");
            }
        } else {
            echo "Código do validar";
        }
    }
}