<?php

namespace App\Models;

use Core\Model\Model;

use PDO;

class AgendaModel extends Model
{
    private $id_agendamento;
    private $data_agend;
    private $horario;
    private $usuario_id;
    private $pet_id;
    private $servicos;


    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }


    public function autenticar()
    {


        $query = "SELECT id_agendamento, data_agend,horario,usuario_id, pet_id, servicos FROM agendamentos";


        $stmt = $this->db->prepare($query);
        // $stmt->bindValue(":email", $this->__get("email"));
        // $stmt->bindValue(":senha", $this->__get("senha"));
        $stmt->execute();



        if ($stmt->rowCount()) {
            $agendamentos = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($agendamentos['id_agendamento'] != '' && $agendamentos['nomepet']) {
                $this->__set('id_agendamento', $agendamentos['id_agendamento']);
                $this->__set('data_agend', $agendamentos['data_agend']);
                $this->__set('horario', $agendamentos['horario']);
                $this->__set('servicos', $agendamentos['servicos']);
            }

            return $this;
        }



        return $this;
    }

    public function validarCadastro()
    {
        $valido = true;

        if (strlen($this->__get("nomepet")) < 3) {
            $valido = false;
            echo "Nome menor que 3";
        }

        return $valido;
    }

    public function getPets()
    {
        $query = "SELECT  data_agend, horario, usuario_id, pet_id, servicos FROM agendamentos";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar()
    {

        $query = "INSERT INTO agendamentos(data_agend, horario,usuario_id, pet_id, servicos) VALUES
                    (:data_agend, :horario, :usuario_id, :pet_id, :servicos)";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":data_agend", $this->__get("data_agend"));
        $stmt->bindValue(":horario", $this->__get("horario"));
        $stmt->bindValue(":usuario_id", $this->__get("usuario_id"));
        $stmt->bindValue(":pet_id", $this->__get("pet_id"));
        $stmt->bindValue(":servicos", $this->__get("servicos"));

        $stmt->execute();

        return $this;
    }

    
}
