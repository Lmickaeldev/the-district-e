<?php
//design patern singloton
namespace App\Core;

//on "impporte" PDO
use PDO;
use PDOException;

class Db extends PDO
{
    // une instance unique de la classe
    private static $instance;

    // information de connection
    private const DBHOST = 'localhost';
    private const DBUSER = 'Lmickael';
    private const DBPASS = 'afpa404';
    private const DBNAME = 'district';

    private function __construct()
    {
        //DSN de connection
        $_dsn = "mysql:dbname=". self::DBNAME . ";host=" . self::DBHOST;

        // on appelle le constructeur de la classe PDO
        try {
         parent::__construct($_dsn, self::DBUSER, self::DBPASS);

         $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
         $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
         $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        } catch (PDOexception $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}



?>