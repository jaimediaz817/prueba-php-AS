<?php 

namespace camaleon\system\database;
use \PDO;

class Connection {
    private $driver='mysql';
    private $host= _DB_HOST;
    private $user= _DB_USER;
    private $password= _DB_PASS;
    private $dbname= _DB_NAME;
    private $charset='utf8';

    protected function connect() {
        try {
            $pdo = new PDO("{$this->driver}:host={$this->host};dbname={$this->dbname};charset={$this->charset}", $this->user, $this->password, null);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}

?>