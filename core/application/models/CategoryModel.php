<?php

namespace camaleon\models;
use camaleon\system\database\CrudBase;

class CategoryModel extends CrudBase {

    private $id;
    private $name;

    const TABLE="categories";
    const ID="cate_id_pk";

    public function __construct() {
        parent::__construct(self::TABLE, self::ID);
        $this->pdo=parent::connect();
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->name;
    }

    /**
     * Select a user
     */
    public function selectAllCategories() {
        $query = "SELECT * from categories";

        $queryPdo = $this->pdo->prepare($query);
        $queryPdo->execute();

        //PDO::FETCH_ASSOC
        $response = $queryPdo->fetchAll(\PDO::FETCH_OBJ);
        return $response;
    }    

    // override
    public function create() {
        $stm = $this->pdo->prepare("INSERT INTO " .self::TABLE. " (cate_nombre) values(?)");
        $res = $stm->execute(array($this->name));
        return $res;
    }
    public function update($idEntity=null) {
        $stm = $this->pdo->prepare("UPDATE " .self::TABLE. " SET cate_nombre=? WHERE cate_id_pk=?");
        $res = $stm->execute(array($this->name, $this->id));
        return $res;
    }

    public function delete($idEntity=null) {
        $stm = $this->pdo->prepare("DELETE FROM " .self::TABLE. " WHERE cate_id_pk=?");
        $res = $stm->execute(array($this->id));
        return $res;
    }
/*
    public function update($idEntity=null) {

    }
*/
}