<?php

namespace camaleon\models;
use camaleon\system\database\CrudBase;

class InventoryGeneralModel extends CrudBase {

    private $id;
    private $idProduct;
    // type: add, remove yo inventory (products)
    private $prodName;
    private $prodId;
    private $total;

    const TABLE="inventory";
    const ID="inve_id_pk";

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

    /* Generate Iventory */
    public function addProductGeneraInventory() {
        $stm = $this->pdo->prepare("INSERT INTO " .self::TABLE. " (inve_prod_id_pk, inve_prod_name, inve_total, inve_date) values(?,?,?, current_date() )");
        $res = $stm->execute(array($this->prodId, $this->prodName, $this->total));
        return $res;
    }

    public function updateProductGeneraInventory() {
        $stm = $this->pdo->prepare("UPDATE " .self::TABLE. " SET inve_total = ?, inve_date = current_date() WHERE inve_prod_id_pk = ?");
        $res = $stm->execute(array($this->total, $this->prodId));
        return $res;
    }

    public function reportProductsCurrencyInventory($idProd = '') {
        $query = "";
        $response = null;
        if ($idProd!= null || $idProd != '') {
            $query = "
                    SELECT iv.inve_prod_name, iv.inve_date, pr.prod_imagen, CONCAT('$',FORMAT(prod_precio, 0)) as price,iv.inve_total
                    FROM inventory iv INNER JOIN products pr
                    ON iv.inve_prod_id_pk = pr.prod_id_pk
                    WHERE pr.prod_id_pk = '?';
            ";
            $queryPdo = $this->pdo->prepare($query);
            $queryPdo->execute(array($idProd));
            //PDO::FETCH_ASSOC
            $response = $queryPdo->fetchAll(\PDO::FETCH_OBJ);
        } else {
            $query = "
                    SELECT iv.inve_prod_name, iv.inve_date, pr.prod_imagen, CONCAT('$',FORMAT(prod_precio, 0)) as price,iv.inve_total
                    FROM inventory iv INNER JOIN products pr
                    ON iv.inve_prod_id_pk = pr.prod_id_pk
            ";
            $queryPdo = $this->pdo->prepare($query);
            $queryPdo->execute(array($idProd));
            //PDO::FETCH_ASSOC
            $response = $queryPdo->fetchAll(\PDO::FETCH_OBJ);
        }
        // return list Report
        return $response;
    }

    //---------------------------------------------------------------------------------------------------------------
    public function create() {}
    public function update($idEntity=null) {}
    public function delete($idEntity=null) {}
}