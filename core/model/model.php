<?php

namespace Core\Model;
use App\database\Connection;
use PDO;

 abstract class Model{
    protected $db;
    static $db_s;

            public function __construct(PDO $db)
            {
                $this->db = $db;
            }

            public function json($array){
                header('Content-Type: aplication/json');
                echo json_encode($array);
                exit;
            }

            public static function GetDb()
            {
                return self::$db_s;
            }

            public static function StartStaticConn()
            {
                self::$db_s = Connection::getDb();
            }
 
}
