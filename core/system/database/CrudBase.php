<?php
namespace camaleon\system\database;

use camaleon\system\database\Connection;
use \PDO;

abstract class CrudBase extends Connection {
    private $table;
    private $pdo;
    private $idField;

    public function __construct($table, $idField=null) {
        $this->table = $table;
        $this->idField = $idField;
        $this->pdo = parent::connect();
    }
    
    public function getAll() {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM $this->table");
            $stm->execute();
            return $stm->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function getById($id, $idField) {
        try {
        $stm = $this->pdo->prepare("SELECT * FROM $this->table WHERE {$this->idField} = ?");
            $stm->execute(array($id));
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function deleteById($id, $idField) {
        try {
            $stm = $this->pdo->prepare("DELETE FROM $this->table WHERE {$this->idField} = ?");
            $stm->execute(array($id));
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    abstract function create();
    abstract function update($idEntity=null);
}