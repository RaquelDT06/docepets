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