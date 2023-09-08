<?php

namespace App\Models;

use Core\Model\Model;
use PDO;
use PDOException;

class RacaModel extends Model
{
    private $id_raca;
    private $descricao;


    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function listar()
    {
        try {
            $query = "SELECT id_raca, descricao FROM raca_pet";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            die("Erro ao listar raça: " . $error->getMessage());
        }
    }
}
