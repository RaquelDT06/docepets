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
        $agendamento = Container::getModel('Agenda');

        $agendamentos = $agendamento->listar();
        $this->view->dados = $agendamentos;

        


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


        $agendamentos2 = $agendamentos->listar();
        $this->view->dados = $agendamentos2;
        $this->render("agendamento", "template_admin");
    }

    public function editar_agenda()
    {

        AuthController::validaAutenticacao();

        // dd($_POST);
        //faz a instancia de produto com a conexão com banco de dados
        $agendamento = Container::getModel('Agenda');

        // private $horario;
        //seta os dados do form nos atributos da classe Usuário
        $agendamento->__set('id_agendamento', isset($_POST['id_agendamento']) ? $_POST['id_agendamento'] : "");
        $agendamento->__set('pet_id', isset($_POST['pet_id']) ? $_POST['pet_id'] : "");
        $agendamento->__set('usuario_id', isset($_POST['usuario_id']) ? $_POST['usuario_id'] : "");
        $agendamento->__set('servicos', isset($_POST['servicos']) ? $_POST['servicos'] : "");
        $agendamento->__set('data_agend', isset($_POST['data_agend']) ? $_POST['data_agend'] : "");
        $agendamento->__set('horario', isset($_POST['horario']) ? $_POST['horario'] : "");


        // dd($agendamento);


        $agendamento->atualizar_agenda();

        //podemos criar um atributo generico no objeto pois estamos herdando de action o view
        $this->view->status = array(
            "status" => "SUCCESS",
            "msg"    => "Categoria atulizada com sucesso"
        );



        $this->view->title = "Admin - Categorias";

        // $this->render("agendamento", "template_admin");
        header("Location: /admin");
    }

    public function atualizar_agenda()
    {
        AuthController::validaAutenticacao();

        $id = $_GET['id'];



        $agendamento = Container::getModel("Agenda");

        $agendamentos = $agendamento->getAgendamentosById($id);
        $this->view->dados = $agendamentos;



        // dd($this->view->dados);

        $pet = $agendamento->listarPetByUsuarioId($this->view->dados['usuario_id']);
        $this->view->dadosPet = $pet;

        // dd($this->view->dadosPet);

        $this->render("agendamentoEditar", "template_admin");
    }

    public function excluir()
    {
        AuthController::validaAutenticacao();

        $id = $_GET['id'];

        $agendamento = Container::getModel('Agenda');
        $agendamento->deletarAgenda($id);

        // $this->index();
        header("Location: /admin");
    }
}
