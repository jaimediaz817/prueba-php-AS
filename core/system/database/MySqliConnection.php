<?php

namespace camaleon\system\database;

class MySqliConnection {
    private static $driver='mysql';
    private static $host= _DB_HOST;
    private static $user= _DB_USER;
    private static $password= _DB_PASS;
    private static $dbname= _DB_NAME;
    private $charset='utf8';

    private static $mysqliVar = '';

    protected function connect() {
        try {
            //echo self::$host . " " . self::$dbname;
            //die();
            $this->mysqliVar =  new \mysqli(self::$host, self::$user, self::$password, self::$dbname);
            $this->mysqliVar->query("SET NAMES 'utf8'");
            return $this->mysqliVar;
        }
        catch(\Exception $ex) {
            print_r($ex);
        }        
    }

}