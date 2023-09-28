<?php

namespace App\controllers;

use Core\controller\Action;
use Core\model\Container;



class UsuarioController extends Action
{
    public function cadastrar()
    {

        // AuthController::validaAutenticacao();
        $this->render("cadastrar", "template_admin");
    }

    public function salvar_usuario()
    {

        // dd($_POST);

        //istancia
        $usuario = Container::getModel("Usuario");

        if (!isset($_SESSION['id_usuario'])) {
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

    public function index()
    {

        AuthController::validaAutenticacao();
        $usuario = Container::getModel("Usuario");
        $usuario  = $usuario->getUsuarios();

        $this->view->dados = $usuario;

        $this->render("index", "template_admin");
    }

    public function editar()
    {
        AuthController::validaAutenticacao();

        $usuario = Container::getModel('Usuario');

        $usuario->__set('id_usuario', isset($_POST['id_usuario']) ? $_POST['id_usuario'] : "");
        $usuario->__set('nome', isset($_POST['nome']) ? $_POST['nome'] : "");
        $usuario->__set('sobrenome', isset($_POST['sobrenome']) ? $_POST['sobrenome'] : "");
        $usuario->__set('email', isset($_POST['email']) ? $_POST['email'] : "");
        $usuario->__set('senha', isset($_POST['senha']) ? $_POST['senha'] : "");

        $usuario->atualizar();

        //podemos criar um atributo generico no objeto pois estamos herdando de action o view
        $this->view->status = array(
            "status" => "SUCCESS",
            "msg"    => "Categoria atulizada com sucesso"
        );



        $this->view->title = "Admin - Categorias";

        // $this->render("agendamento", "template_admin");
        $this->render("usuarioEditar", "template_admin");
    
    }

    

    public function excluir()
    {
        AuthController::validaAutenticacao();

        $id = $_GET['id'];

        

        $usuario = Container::getModel('Usuario');
        $usuario->deletarUsuario($id);

        // $this->index();
        header("Location: /user");
    }



    public function atualizar()
{
    AuthController::validaAutenticacao();

    // Faz a instância do modelo Usuario
    $usuario = Container::getModel('Usuario');

    $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
    $senha_atual = isset($_POST['senha_atual']) ? $_POST['senha_atual'] : "";

    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $email_atual = isset($_POST['email_atual']) ? $_POST['email_atual'] : "";

    // Seta os dados do formulário nos atributos do modelo Usuario
    $usuario->__set('id', isset($_POST['id']) ? $_POST['id'] : "");
    $usuario->__set('nome', isset($_POST['nome']) ? $_POST['nome'] : "");
    $usuario->__set('sobrenome', isset($_POST['sobrenome']) ? $_POST['sobrenome'] : "");
    $usuario->__set('email', $email); // Use a variável $email

    date_default_timezone_set('America/Cuiaba');
    $usuario->__set('update_at', date('Y-m-d H:i:s')); // Use 'update_at' em vez de 'updated_at'

    if ($senha === '') {
        $usuario->__set('senha', $senha_atual);
    } else {
        $usuario->__set('senha', md5($senha));
    }

    if ($usuario->validarCadastro()) {
        // SUCCESS ao validar cadastro

        if (count($usuario->getUsuarioPorEmail()) == 0 || $email === $email_atual) {
            $usuario->atualizar();

            // Podemos criar um atributo genérico no objeto, pois estamos herdando de Action o view
            $this->view->status = array(
                "status" => "SUCCESS",
                "msg"    => "Usuário atualizado com sucesso"
            );

            $usuarios = $usuario->getUsuarioPorId();
            $this->view->dados = $usuarios;

            $this->render("usuarioEditar", "template_admin");
        } else {
            // Caso retorne 1 linha na query, indica que já está cadastrado no banco de dados
            $this->view->status = array(
                "status" => "ERROR",
                "msg"    => "Erro ao cadastrar usuário, e-mail já existe no banco de dados"
            );

            $this->view->tempUsuario = array(
                "nome"      => isset($_POST['nome']) ? $_POST['nome'] : "",
                "sobrenome" => isset($_POST['sobrenome']) ? $_POST['sobrenome'] : "",
                "email"     => $email, // Use a variável $email
                "senha"     => isset($_POST['senha']) ? $_POST['senha'] : ""
            );

            $this->render("usuarioEditar", "template_admin");
        }
    } else {
        // Erro na digitação, < que 3 caracteres
        // Armazena os dados para recarregar o formulário

        $this->view->tempUsuario = array(
            "nome" => isset($_POST['nome']) ? $_POST['nome'] : "",
            "sobrenome" => isset($_POST['sobrenome']) ? $_POST['sobrenome'] : "",
            "email" => $email, // Use a variável $email
            "senha" => isset($_POST['senha']) ? $_POST['senha'] : ""
        );

        $this->view->status = array(
            "status" => "ERROR",
            "msg"    => "Erro ao editar usuário, verifique os campos digitados e tente novamente"
        );

        // Redirecionar para a página de edição ou outra ação apropriada
        header("Location: /user");
    }
}

}
