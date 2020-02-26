<?php

namespace camaleon\models;
use camaleon\system\database\CrudBase;

class UserModel extends CrudBase {

    private $name;
    private $nickname;
    private $password;
    private $status;

    const TABLE="users";
    const ID="usua_id_pk";

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
    public function selectAllUsers() {
        $query = "SELECT * from users";

        $queryPdo = $this->pdo->prepare($query);
        $queryPdo->execute();

        //PDO::FETCH_ASSOC
        $response = $queryPdo->fetchAll(\PDO::FETCH_OBJ);
        return $response;
    }

    public function selectUserLogin($user='', $pass='') {
        $response = null;

        if ($user!= '' && $pass!='') {
            $query = "
                        SELECT * FROM users us WHERE us.usua_nickname = :nickname
                        AND us.usua_password = :password
            ";
            $return = $this->pdo->prepare($query);
            $return->execute(array(':nickname' => $user, ':password'=> $pass));
            //PDO::FETCH_ASSOC
            $response = $return->fetchAll(\PDO::FETCH_ASSOC);
            return $response;
        }
    }

    public function activeAccount($user='', $pass='') {
        $response = null;

        if ($user!= '' && $pass!='') {
            $query = "
                        SELECT * FROM users us WHERE us.usua_nickname = :nickname
                        AND us.usua_password = :password
            ";
            $return = $this->pdo->prepare($query);
            $return->execute(array(':nickname' => $user, ':password'=> $pass));
            //PDO::FETCH_ASSOC
            $response = $return->fetchAll(\PDO::FETCH_ASSOC);
            return $response;
        }
    }    

    public function activateAccountEmail($idEntity=null) {
        $stm = $this->pdo->prepare("UPDATE " .self::TABLE. " SET usua_status_account='1' WHERE usua_id_pk = ?");
        $res = $stm->execute(array($idEntity));
        return $res;
    }

    // override
    public function create() {}   
    public function update($idEntity=null) {} 
}