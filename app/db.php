<?php

namespace App;

class DB extends \Prefab
{
    private static $_instance = null;
    private $dbconn = null;

    private function __construct()
    {
        $DB_SQLITE_FILE = DATABASEFILE;
        $this->dbconn = new \DB\SQL('sqlite:'.$DB_SQLITE_FILE);
    }

    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function connect()
    {
        if ($this->dbconn) {
            return $this->dbconn;
        } else echo '<br>DB: nessuna connessione :(';
    }
    
    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
