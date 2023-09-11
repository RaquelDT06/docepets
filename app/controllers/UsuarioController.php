<?php

namespace App\controllers;

use Core\controller\Action;
use Core\model\Container;



class UsuarioController extends Action
{
    public function cadastrar()
    {

        AuthController::validaAutenticacao();
        $this->render("cadastrar", "template_admin");
    }

    public function salvar_usuario()
    {

        // dd($_POST);

        //istancia
        $usuario = Container::getModel("Usuario");

        if(!isset($_SESSION['id_usuario'])) {
            // Nao logado
        }

        //recebe dados
        $usuario->__set('nome', $_POST['nome']);
        $usuario->__set('sobrenome', $_POST['sobrenome']);
        $usuario->__set('email', $_POST['email']);
        $usuario->__set('senha', md5($_POST['senha']));
        $usuario->__set('nivel', isset($_POST["nivel"]) ? 1 : 0);

        //valida campos
        // dd($_POST);

        if ($usuario->validarCadastro()) {
            if (count($usuario->getUsuarioporEmail()) == 0) {

                $usuario->salvar();

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
                $this->view->temusuario = array(
                    "nome" => $_POST['nome'],
                    "sobrenome" => $_POST['sobrenome'],
                    "email" => $_POST['email'],
                    "senha" => $_POST['senha'],
                    "nivel" => isset($_POST['nivel']) ? 1 : 0

                );

                $this->render("cadastrar", "template_admin");
            }
        } else {
            echo "Código do validar";
        }
    }
}
