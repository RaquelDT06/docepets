<?php
namespace Core\Model;
use App\database\Connection;
use PDO;

class Query 
{
    protected static $conn;

    public static function StartStaticConn()
    {
        self::$conn = Connection::getDb();
    }

    public static function execute($sql)
    {
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}