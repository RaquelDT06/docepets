<?php

namespace App\Models;

// namespace App\models\UsuarioModel;

use Core\Model\Model;

use PDO;

class PetModel extends Model
{
    private $id_pet_cad;
    private $nasc_data;
    private $genero;
    private $tipo_id;
    private $raca_id;
    private $usuario_id;
    private $nomepet;
 
    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function autenticar(){
        $query = "SELECT id_pet_cad, nasc_data, genero, tipo_id,raca_id,usuario_id, nomepet FROM cadastro_pet where usuario_id =:usuario_id ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":usuario_id", $this->__get("usuario_id"));
        $stmt->execute();        

        if($stmt->rowCount()){
            $pet = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($pet['id_pet_cad'] != '' && $pet['nomepet']){
                $this->__set('id_pet_cad', $pet['id_pet_cad']);
                $this->__set('nomepet', $pet['nomepet']);
                $this->__set('nasc_data', $pet['nasc_data']);
                $this->__set('genero', $pet['genero']);
            
            }
            return $this;
        }

        return $this;
        
    }

    public function validarCadastro(){
        $valido = true;

        if(strlen($this->__get("nomepet")) < 3){
            $valido = false;
            echo "Nome menor que 3";
        }

         return $valido;
    }

    public function getUsuarioPorEmail(){
        $query = " SELECT nome,  sobrenome, email FROM usuario WHERE email = :email";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":email", $this->__get("email"));
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        public function salvar(){
        $query = "INSERT INTO cadastro_pet(nasc_data, genero, tipo_id, raca_id, usuario_id,nomepet) VALUES
                    (:nasc_data, :genero, :tipo_id, :raca_id, :usuario_id, :nomepet)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":nasc_data", $this->__get("nasc_data"));
        $stmt->bindValue(":genero", $this->__get("genero"));
        $stmt->bindValue(":tipo_id", $this->__get("tipo_id"));
        $stmt->bindValue(":raca_id", $this->__get("raca_id"));
        $stmt->bindValue(":usuario_id", $this->__get("usuario_id"));
        $stmt->bindValue(":nomepet", $this->__get("nomepet"));
        
        $stmt->execute();

        return $this;
    }

}