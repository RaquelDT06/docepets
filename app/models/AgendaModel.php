<?php

namespace App\Models;

use Core\Model\Model;
use Core\Model\Query;
use Exception;
use PDO;
use PDOException;

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


            if ($agendamentos['id_agendamento'] != '' && $agendamentos['pet_id']) {
                $this->__set('id_agendamento', $agendamentos['id_agendamento']);
                $this->__set('data_agend', $agendamentos['data_agend']);
                $this->__set('horario', $agendamentos['horario']);
                $this->__set('usuario_id', $agendamentos['usuario_id']);
                $this->__set('pet_id', $agendamentos['pet_id']);
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

    public function getAgendamentos() {
        $sql = "SELECT a.id_agendamento, a.data_agend, a.horario, a.usuario_id, a.pet_id, 
                a.servicos, u.nome as nome_usuario, u.sobrenome as sobrenome_usuario, p.nomepet
                FROM agendamentos as a 
                INNER JOIN usuario as u ON a.usuario_id = u.id_usuario
                INNER JOIN cadastro_pet as p ON a.pet_id = p.id_pet_cad";
        return $this->db->query($sql)->fetchAll();
    }

    public function getAgendamentosById($id) {
        $sql = "SELECT a.id_agendamento, a.data_agend, a.horario, a.usuario_id, a.pet_id, 
                a.servicos, u.nome as nome_usuario, u.sobrenome as sobrenome_usuario, p.nomepet
                FROM agendamentos as a 
                INNER JOIN usuario as u ON a.usuario_id = u.id_usuario
                INNER JOIN cadastro_pet as p ON a.pet_id = p.id_pet_cad where id_agendamento = $id";
        return $this->db->query($sql)->fetch();
    }
    

    public static function listar()
{
    try {
        $id_usuario = $_SESSION['id_usuario'];
        return Query::execute("SELECT id_pet_cad, nomepet FROM cadastro_pet 
        where usuario_id = $id_usuario");
    } catch (PDOException $error) {
        die("Erro ao listar tipo: " . $error->getMessage());
    }
}


    public static function listarPetByUsuarioId($agendamentos)
    {
        try {            
            return Query::execute("SELECT id_pet_cad, nomepet FROM cadastro_pet 
            where usuario_id = $agendamentos");
        } catch (PDOException $error) {
            die("Erro ao listar tipo: " . $error->getMessage());
        }
    }

    public function deletarAgenda($id)
	{
        
        $query = "DELETE from agendamentos where id_agendamento = :id_agendamento";
		// $query = "update usuarios set ativo = 0 where id = :id_usuario";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_agendamento', $id);
		$stmt->execute();

		return true;
	}

    public function atualizar_agenda()
{

    
    // Verifique se o ID do agendamento está definido
    if (!$this->id_agendamento) {
        throw new Exception ("ID do agendamento não definido.");
    }

   

    // Construa a consulta SQL para atualização
    $query = "UPDATE agendamentos SET 
                data_agend = :data_agend,
                horario = :horario,
                usuario_id = :usuario_id,
                pet_id = :pet_id,
                servicos = :servicos
              WHERE id_agendamento = :id_agendamento";

    // Prepare a consulta
    $stmt = $this->db->prepare($query);

    // dd($this);
    // Associe os valores a serem atualizados
    $stmt->bindValue(":data_agend", $this->__get("data_agend"));
    $stmt->bindValue(":horario", $this->__get("horario"));
    $stmt->bindValue(":usuario_id", $this->__get("usuario_id"));
    $stmt->bindValue(":pet_id", $this->__get("pet_id"));
    $stmt->bindValue(":servicos", $this->__get("servicos"));
    $stmt->bindValue(":id_agendamento", $this->__get("id_agendamento"));

    // Execute a consulta
    $stmt->execute();

    // Verifique se a atualização foi bem-sucedida
    if ($stmt->rowCount() > 0) {
        return true; // Atualização bem-sucedida
    } else {
        return false; // Falha na atualização
    }
}

}