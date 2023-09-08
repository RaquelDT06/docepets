<?php

namespace App\Models;

use Core\Model\Model;

use PDO;

class AgendaModel extends Model
{
    private $id_agendamento;
    private $nasc_data;
    private $animal_tipo;
    private $data_agend;
    private $horario;
    private $usuario_id;
    private $pet_id;
   

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function autenticar(){


        $query = "SELECT id_agendamento, nasc_data, animal_tipo, data_agend,horario,usuario_id, pet_id FROM agendamentos 
        WHERE email = :email and senha = :senha and ativo = 1";

    
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":email", $this->__get("email"));
        $stmt->bindValue(":senha", $this->__get("senha"));
        $stmt->execute();
        
     

        if($stmt->rowCount()){
            $agendamento = $stmt->fetch(PDO::FETCH_ASSOC);

            
            if($agendamento['id_agendamento'] != '' && $agendamento['nome']){
                $this->__set('id_agendamento', $agendamento['id_agendamento']);
                $this->__set('nasc_data', $agendamento['nasc_data']);
                $this->__set('animal_tipo', $agendamento['animal_tipo']);
                $this->__set('data_agend', $agendamento['data_agend']);
                $this->__set('horario', $agendamento['horario']);
               
            }

            return $this;
        }

    
        
        return $this;
        
        
    }

    public function validarCadastro(){
        $valido = true;

        if(strlen($this->__get("nome")) < 3){
            $valido = false;
            echo "Nome menor que 3";
        }

        if(strlen($this->__get("sobrenome")) < 3){
            $valido = false;
            echo "sobrenome menor que 3";
        }

        if(strlen($this->__get("email")) < 3){
            $valido = false;
            echo "email menor que 3";
        }

        if(strlen($this->__get("senha")) < 3){
            $valido = false;
            echo "senha menor que 3";
        }

        return $valido;
    }

    public function getUsuarioPorEmail(){
        $query = "SELECT nome, sobrenome, email FROM usuario WHERE email = :email";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":email", $this->__get("email"));
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar(){
        $query = "INSERT INTO usuario(nome, sobrenome, email, senha, nivel) VALUES
                    (:nome, :sobrenome, :email, :senha, :nivel)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":nome", $this->__get("nome"));
        $stmt->bindValue(":sobrenome", $this->__get("sobrenome"));
        $stmt->bindValue(":email", $this->__get("email"));
        $stmt->bindValue(":senha", $this->__get("senha"));
        $stmt->bindValue(":nivel", $this->__get("nivel"));
        
        $stmt->execute();

        return $this;
    }

}