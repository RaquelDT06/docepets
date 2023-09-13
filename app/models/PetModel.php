<?php

namespace App\Models;

use Core\Model\Model;
use Core\Model\Query;
use PDOException;

class PetModel extends Model
{
    private $id_pet_cad;
    private $nasc_data;
    private $genero;
    private $tipo_id;
    private $raca_id;
    private $usuario_id;
    private $nomepet;
    private $observacoes;
 
    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function validarCadastro(){
        $valido = true;

        if(strlen($this->__get("nomepet")) < 3){
            $valido = false;
            echo "Nome menor que 3";
        }

         return $valido;
    }

     public function salvar(){
        $query = "INSERT INTO cadastro_pet(nasc_data, genero, tipo_id, raca_id, usuario_id,nomepet, observacoes) VALUES
                    (:nasc_data, :genero, :tipo_id, :raca_id, :usuario_id, :nomepet, :observacoes)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":nasc_data", $this->__get("nasc_data"));
        $stmt->bindValue(":genero", $this->__get("genero"));
        $stmt->bindValue(":tipo_id", $this->__get("tipo_id"));
        $stmt->bindValue(":raca_id", $this->__get("raca_id"));
        $stmt->bindValue(":usuario_id", $this->__get("usuario_id"));
        $stmt->bindValue(":nomepet", $this->__get("nomepet"));
        $stmt->bindValue(":observacoes", $this->__get("observacoes"));
        
        $stmt->execute();

        return $this;
    }

    public static function listar()
    {
        try {
            return Query::execute("SELECT nomepet FROM cadastro_pet");
        } catch (PDOException $error) {
            die("Erro ao listar raça: " . $error->getMessage());
        }
    }

}