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

      //  dd($_POST);

        //istancia
        $pet = Container::getModel("Pet");
        if(!isset($_SESSION['id_usuario'])) {
            // Nao logado
        }

        //recebe dados
        $pet->__set('nomepet', $_POST["nomepet"]);
        $pet->__set('nasc_data', $_POST['nasc_data']);
        $pet->__set('genero', $_POST['genero']);
        $pet->__set('tipo_id', $_POST['tipo_id']);
        $pet->__set('raca_id', $_POST['raca_id']);
        $pet->__set("usuario_id", $_SESSION['id_usuario']);      

        //valida campos

        if ($pet->validarCadastro()) {
            if (count($pet->getPet()) == 0) {

                $pet->salvar();

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
                $this->view->tempet = array(
                    'nomePet', $_POST['nomePet'],
                    'nasc_data', $_POST['nasc_data'],
                    'genero', $_POST['genero'],
                    'tipo_id', $_POST['tipo_id'],
                    'raca_id', $_POST["raca_id"],
                    'usuario_id', $_POST["usuario_id"]
                ); 

                $this->render("cadastrar", "template_admin");
            }
        } else {
            echo "Código do validar";
        }
    }
}