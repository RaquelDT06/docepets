<?php

namespace App\Models;

use Core\Model\Model;
use PDO;


class UsuarioModel extends Model
{
    private $id_usuario;
    private $nome;
    private $sobrenome;
    private $email;
    private $senha;
    private $nivel;
    private $ativo;
    private $created_at;
    private $update_at;
    private $deleted_at;
    // private $data_contrato;
    // private $final_contrato;

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

        $query = "SELECT id_usuario, nome, sobrenome, email,senha, nivel, ativo FROM usuario 
        WHERE email = :email and senha = :senha and ativo = 1";


        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":email", $this->__get("email"));
        $stmt->bindValue(":senha", $this->__get("senha"));
        $stmt->execute();



        if ($stmt->rowCount()) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($usuario['id_usuario'] != '' && $usuario['nome']) {
                $this->__set('id_usuario', $usuario['id_usuario']);
                $this->__set('nome', $usuario['nome']);
                $this->__set('sobrenome', $usuario['sobrenome']);
                $this->__set('email', $usuario['email']);
                $this->__set('nivel', $usuario['nivel']);
                $this->__set('ativo', $usuario['ativo']);
            }



            return $this;
        }


        return $this;
    }

    public function validarCadastro()
    {
        $valido = true;

        if (strlen($this->__get("nome")) < 3) {
            $valido = false;
            echo "Nome menor que 3";
        }

        if (strlen($this->__get("sobrenome")) < 3) {
            $valido = false;
            echo "sobrenome menor que 3";
        }

        if (strlen($this->__get("email")) < 3) {
            $valido = false;
            echo "email menor que 3";
        }

        if (strlen($this->__get("senha")) < 3) {
            $valido = false;
            echo "senha menor que 3";
        }

        return $valido;
    }

    public function getUsuarioPorEmail()
    {
        $query = "SELECT nome, sobrenome, email, nivel FROM usuario WHERE email = :email";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":email", $this->__get("email"));
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuarioPorId()
    {
        $query = "SELECT id_usuario, nome, sobrenome, email, senha, nivel from usuario where id_usuario = :id_usuario";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function salvar()
    {
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

    public function getUsuarios()
    {
        $sql = "SELECT id_usuario, nome,sobrenome,email,senha  FROM usuario";
        return $this->db->query($sql)->fetchAll();
    }

    public function deletarUsuario($id)
	{
        
        $query = "DELETE from usuario where id_usuario = :id_usuario";

        echo $query;

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $id);
		$stmt->execute();

		return true;
	}


    public function atualizar()
{
    $query = "UPDATE usuario SET nome = :nome, sobrenome = :sobrenome, email = :email, senha = :senha WHERE id_usuario = :id_usuario";

    $stmt = $this->db->prepare($query);

    $stmt->bindValue(':nome', $this->__get('nome'));
    $stmt->bindValue(':sobrenome', $this->__get('sobrenome'));
    $stmt->bindValue(':email', $this->__get('email'));
    $stmt->bindValue(':senha', $this->__get('senha')); //md5() -> hash 32 caracteres
    $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));

    $stmt->execute();

    return $this;
}

}
