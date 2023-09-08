<?php

namespace Core\Model;
use PDO;

 abstract class Model{
    protected $db;

        public function __construct(PDO $db)
        {
            $this->db = $db;
        }

        public function json($array){
            header('Content-Type: aplication/json');
            echo json_encode($array);
            exit;
        }
}

?>
