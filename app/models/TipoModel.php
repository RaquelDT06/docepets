<?php

namespace App\Models;

use Core\Model\Model;
use Core\Model\Query;
use PDO;
use PDOException;

class TipoModel extends Model
{
    private $id_pet;
    private $descricao;


    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public static function listar()
    {
        try {
            return Query::execute("SELECT id_pet, descricao FROM tipo_pet");
        } catch (PDOException $error) {
            die("Erro ao listar tipo: " . $error->getMessage());
        }
    }
}
