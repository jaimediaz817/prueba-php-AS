<?php

namespace camaleon\models;
use camaleon\system\database\CrudBase;

class InventoryModel extends CrudBase {

    private $id;
    private $idProduct;
    // type: add, remove yo inventory (products)
    private $type;
    private $quantity;

    const TABLE="inventory_movements";
    const ID="movi_id_pk";

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
     * Select Inventory By Produc ID
     */
    public function selectAllMovementsByProduct($idProduct) {
        $query = "
                    SELECT mov.movi_cantidad, mov.movi_tipo, mov.movi_fecha_modificacion, pro.prod_nombre, pro.prod_id_pk, pro.prod_precio
                    FROM ". self::TABLE. " mov INNER JOIN products pro 
                    ON pro.prod_id_pk = mov.prod_id_fk
                    WHERE prod_id_fk =?";

        $queryPdo = $this->pdo->prepare($query);
        $queryPdo->execute(array($idProduct));

        //PDO::FETCH_ASSOC
        $response = $queryPdo->fetchAll(\PDO::FETCH_OBJ);
        return $response;
    }

    public function selectMovAddProduct($id, $type) {
        $query = "
                    SELECT SUM(mov.movi_cantidad) as addTotals
                    FROM inventory_movements mov INNER JOIN products pro 
                    ON pro.prod_id_pk = mov.prod_id_fk
                    AND mov.movi_tipo = ?
                    WHERE prod_id_fk = ?
        ";
        $queryPdo = $this->pdo->prepare($query);
        $queryPdo->execute(array($type, $id));

        //PDO::FETCH_ASSOC
        $response = $queryPdo->fetchAll(\PDO::FETCH_OBJ);
        return $response;
    }

    // override
    public function generateMovement() {
        $stm = $this->pdo->prepare("INSERT INTO " .self::TABLE. " (prod_id_fk, movi_cantidad, movi_tipo, movi_fecha_modificacion) values(?,?,?, current_date() )");
        $res = $stm->execute(array($this->idProduct, $this->quantity, $this->type));
        return $res;
        // date('Y-m-d')
    }


    public function addProductGeneraInventory() {
        
    }


    //---------------------------------------------------------------------------------------------------------------
    public function create() {
        
    }

    public function update($idEntity=null) {
        // $stm = $this->pdo->prepare("UPDATE " .self::TABLE. " SET cate_nombre=? WHERE cate_id_pk=?");
        // $res = $stm->execute(array($this->name, $this->id));
        // return $res;
    }

    public function delete($idEntity=null) {
        // $stm = $this->pdo->prepare("DELETE FROM " .self::TABLE. " WHERE cate_id_pk=?");
        // $res = $stm->execute(array($this->id));
        // return $res;
    }
}