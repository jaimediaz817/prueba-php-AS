<?php

namespace camaleon\models;
use camaleon\system\database\CrudBase;

class ProductModel extends CrudBase {

    private $id;
    private $name;
    private $pathImgage;
    private $price;
    private $quantity;
    private $category;

    const TABLE="products";
    const ID="prod_id_pk";

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

    public function getLastId() {
        $query = "SELECT LAST_INSERT_ID();";
        $queryPdo = $this->pdo->prepare($query);
        $queryPdo->execute();
        $response = $queryPdo->fetch(\PDO::FETCH_UNIQUE);
        return $response;        
    }

    /**
     * Select a user
     */
    public function selectAllProducts() {
        $query = "
                    SELECT  pr.prod_id_pk, pr.prod_nombre, pr.prod_imagen, pr.prod_precio, pr.cate_id_fk, pr.prod_status, ca.cate_nombre
                    FROM products pr INNER JOIN categories ca
                    ON ca.cate_id_pk = pr.cate_id_fk;
        ";

        $queryPdo = $this->pdo->prepare($query);
        $queryPdo->execute();

        //PDO::FETCH_ASSOC
        $response = $queryPdo->fetchAll(\PDO::FETCH_OBJ);
        return $response;
    }    

    // override
    public function create() {
        $stm = $this->pdo->prepare("INSERT INTO " .self::TABLE. " (prod_nombre, prod_imagen, cate_id_fk, prod_precio) values(?,?,?,?)");
        $res = $stm->execute(array($this->name, $this->pathImgage, $this->category, $this->price));
        return $res;
    }
    public function update($idEntity=null) {
        $stm = $this->pdo->prepare("UPDATE " .self::TABLE. " SET prod_nombre=?, cate_id_fk=?,prod_precio=?, prod_imagen=?  WHERE prod_id_pk=?");
        $res = $stm->execute(array($this->name, $this->category, $this->price, $this->pathImgage, $this->id));
        return $res;
    }

    public function delete($idEntity=null) {
        $stm = $this->pdo->prepare("UPDATE " .self::TABLE. " SET prod_status=0 WHERE prod_id_pk=?");
        $res = $stm->execute(array($this->id));
        return $res;
    }
/*
    public function update($idEntity=null) {

    }
*/
}