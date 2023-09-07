<?php
    namespace Core\model;

    use App\database\Connection;
    

    class Container{

        // getModel("produto");

        //método responsavel por retornar o moelo solicitado
        //já instanciado e inclusive ja com a conexão com banco de banco de dados
        public  static function getModel($model){
            //montando o caminho de onde o model se localiza e unindo.
            $class = "\\App\\models\\" . ucFirst($model) . "model"; 

            //puxando a conexão com o banco pelo metodo estático
            $conn = Connection::getDb();
            

            return new $class($conn);
        }
    }
?>