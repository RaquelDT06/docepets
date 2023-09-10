<?php

namespace App\controllers;

use Core\controller\Action;
use Core\model\Container;
session_start();

class PetController extends Action
{

    public function cadastro_pet()
    {

        AuthController::validaAutenticacao();
        $this->render("cadastro_pet", "template_admin");
    }

    public function salvar_pet()
    {

        // dd($_POST);

        //istancia
        $pet = Container::getModel("Pet");

        if (!isset($_SESSION['id_pet_cad'])) {
            // Nao logado
        }


        //recebe dados
        $pet->__set('nomepet', $_POST['nomepet']);
        $pet->__set('nasc_data', $_POST['nasc_data']);
        $pet->__set('genero', $_POST['genero']);
        $pet->__set('tipo_id', $_POST['id_pet']);
        $pet->__set('raca_id', $_POST['id_raca']);
        $pet->__set('observacoes', $_POST['observacoes']);
        $pet->__set('usuario_id', $_SESSION['id_usuario']);


        //valida campos

        if ($pet->validarCadastro()) {
            if (0 == 0) {

                $pet->salvar();

                $this->view->status = array(
                    "status" => "SUCCESS",
                    "msg" => "Cadastro realizado com sucesso"
                );
                $this->render("cadastro_pet", "template_admin");
            } else {
                $this->view->status = array(
                    "status" => "ERROR",
                    "msg" => "Cadastro não realizado"
                );

                // salvar e permanecer dados
                $this->view->tempet = array(
                    'nomePet', $_POST['nomePet'],
                    'nasc_data', $_POST['nasc_data'],
                    'genero', $_POST['genero'],
                    'tipo_id', $_POST['id_pet'],
                    'raca_id', $_POST["id_raca"],
                    'usuario_id', $_POST["usuario_id"],
                    'observacoes', $_POST["observacoes"]
                );

            }
        } else {
            echo "Código do validar";
        }
    }
}
