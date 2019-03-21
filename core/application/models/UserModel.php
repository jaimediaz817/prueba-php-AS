<?php

namespace camaleon\models;
use camaleon\system\database\CrudBase;

class UserModel extends CrudBase {
    private $id;
    private $name;
    private $lastName;
    private $date;
    private $username;
    private $password;
    private $createdAt;

    const TABLE="usuario";
    const ID="usua_id_pk";

    private $pdo;

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

    // custom
    public function innerJoin() {
        $perfName = "parlos";
        $query = "
                    SELECT us.usua_nombres, us.usua_apellidos, up.usua_perf_code
                    FROM usuario us INNER JOIN usua_perf up ON us.usua_id_pk = up.usua_id_fk
                    INNER JOIN perfil pe ON pe.perf_id_pk = up.perf_id_fk 
                    WHERE pe.perf_nombres = :perf_param
        ";
        $query2 = "SELECT * FROM usuario";
        $consulta = $this->pdo->prepare($query);
        $consulta->execute(array(':perf_param' => $perfName));
        //PDO::FETCH_ASSOC
        $res = $consulta->fetchAll(\PDO::FETCH_OBJ);
        return $res;
    }

    // override
    public function create() {
        $stm = $this->pdo->prepare("INSERT INTO " .self::TABLE. " (usua_nombres, usua_apellidos, usua_fecha_creacion, usua_username, usua_password, created_at) values(?,?,?,?,?,?)");
        $stm->execute(array($this->name, $this->lastName, $this->date, $this->username, $this->password, $this->createdAt));
    }
    public function update($idEntity=null) {
        $stm = $this->pdo->prepare("UPDATE " .self::TABLE. " SET usua_nombres=?, usua_apellidos=?, usua_fecha_creacion=?, usua_username=?, usua_password=?, created_at=? WHERE usua_id_pk=?");
        $stm->execute(array($this->name, $this->lastName, $this->date, $this->username, $this->password, $this->createdAt,$idEntity));
    }
}

?>