<?php
    namespace App\database;
    
    use PDO;
    use PDOException;

    class Connection{

        public static function getDb(){
            #informações do banco
            $host           =   "localhost";
            $user           =   "root";
            $pass           =   "root";
            $db_name        =   "docepets_php";
            $db_driver      =   "mysql";
            $charset        =   "utf8";
            $port           =   3306;

            #informações sobre o sistema
            $nome_sistema   =   "";
            $email          =   "";
      
             try {
                $conn = new PDO (
                    $db_driver .
                    ":host=" .$host .
                    ";port=". $port.
                    ";dbname=" . $db_name.
                    ";charset". $charset,
                    $user,
                    $pass);

                return $conn;
            } catch (PDOException $error) {
                
                die("Erro de Conexão: ". $error->getMessage());
            }
        }
    }

?>