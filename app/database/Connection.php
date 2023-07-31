<?php
    namespace App\database;
    
    use PDO;
    use PDOException;

    class Connection{

        public static function getDb(){
            #informaões do banco
            $host           =   "localhost";
            $user           =   "root";
            $pass           =   "root";
            $db_name        =   "docepets";
            $db_driver      =   "mysql";
            $charset        =   "utf8";
            $port           =   3307;

            #informações sobre o sistema
            $nome_sistema   =   "";
            $email          =   "";

            // try {
                $conn = new PDO (
                    $db_driver .
                    ":host=" .$host .
                    ";port=". $port.
                    ";dbname=" . $db_name.
                    ";charset". $charset,
                    $user,
                    $pass);

                return $conn;
            // } catch (PDOException $error) {
            //     // Vamos trata o erro caso exista em outro momento
            //     // por exemplo podemos enviar um email para o adm caso
            //     // um erro aconteça na conexão
            //     die("Erro de Conexão: ". $error->getMessage());
            // }
        }
    }

?>