<?php

namespace camaleon\models;
use camaleon\system\database\CrudMySqliBase;

class PerfilModel extends CrudMySqliBase {

    public function __construct() {
        parent::__construct();
        $con = parent::connect();
    }
    
    // public function query($query) {
    //     $res = parent::query($query, '');
    //     return $res;
    // }

}